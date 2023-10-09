<?php

namespace app\commands;

use app\models\UserAssignment;
use yii\console\Controller;
use app\models\Tender;
use app\models\Supervisor;
use app\models\User;
use Yii;
use yii\helpers\Html;

class TenderReminderCommand extends Controller
{
    public function actionSendReminders()
    {
        $reminderDate = date('Y-m-d', strtotime('+1 week')); // Calculate the reminder date (one week from today)

        $tenders = Tender::find()
            ->where(['<=', 'expiration_date', $reminderDate]) // Fetch tenders with expiration date one week or less from today
            ->all();

        foreach ($tenders as $tender) {
            // Send reminder email to each supervisor
            $this->sendReminderEmailToSupervisors($tender);
        }
    }

    private function sendReminderEmailToSupervisors($tender)
    {
        // Fetch user assignments for the tender
        $userAssignments = UserAssignment::find()
            ->where(['tender_id' => $tender->id])
            ->all();
    
        // Fetch supervisors associated with the user assignments
        $supervisors = [];
        foreach ($userAssignments as $userAssignment) {
            // Assuming there is a "user_id" field in the UserAssignment model that represents the supervisor's ID
            $supervisor = User::find()
                ->where(['id' => $userAssignment->user_id])
                ->one();
    
            if ($supervisor !== null) {
                $supervisors[] = $supervisor;
            }
        }
    
        // Prepare and send reminder email to each supervisor
        foreach ($supervisors as $supervisor) {
            $this->sendReminderEmail($supervisor->email, $tender);
        }
    }
    private function sendReminderEmail($email, $tender)
    {
        // Prepare and send the reminder email
        $mailer = Yii::$app->mailer;

        $mailer->compose('reminder-email', ['tender' => $tender])
            ->setFrom(Yii::$app->params['nicholaussomi5@gmail.com'])
            ->setTo($email)
            ->setSubject('Reminder: Tender Expiration')
            ->setHtmlBody('
            <html>
            <head>
                <style>
                    /* CSS styles for the email body */
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                    }

                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        padding: 20px;
                        background-color: #ffffff;
                        border: 1px solid #dddddd;
                        border-radius: 4px;
                        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                    }

                    h1 {
                        color: blue;
                        text-align: center;
                    }

                    p {
                        color: #666666;
                    }

                    .logo {
                        text-align: center;
                        margin-bottom: 20px;
                    }

                    .logo img {
                        max-width: 200px;
                    }

                    .assigned-by {
                        font-weight: bold;
                    }

                    .button {
                        display: inline-block;
                        padding: 10px 20px;
                        background-color: #3366cc;
                        color: white;
                        text-decoration: none;
                        border-radius: 4px;
                        margin-top: 20px;
                    }

                    .button:hover {
                        background-color: #235daa;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="logo">
                        <img src="https://teratechcomponents.com/wp-content/uploads/2011/06/Tera_14_screen-234x60.png" alt="teralogo">
                    </div>
                    <h1>TERATECH ANNOUCEMENT</h1>
                    <p>Dear Staff,</p>
                    <p>You have now less a week untill to this tender submission </p>
                    <ul>
                        <li>Tender Title: ' . Html::encode($tender->title) . '</li>
                        <li>Submission Date: ' . Html::encode(date('Y-m-d',$tender->expired_at)) . '</li>
                    </ul>
                    <p>If you have any questions or need further assistance, feel free to contact us.</p>
        ')
            ->send();
    }
}
