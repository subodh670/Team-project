<?php
if(mail("harogya21@tbc.edu.np","Test email from localhost", "I am message body for the email" ))
{
echo "Mail Sent";
}
else
{
echo "Unable to send email";
}
?>
