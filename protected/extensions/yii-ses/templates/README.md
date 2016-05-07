#Usage
When you go to send your email, you have the option to choose your template.
The template name will be your file name without the extension.
SESCompenent will check for that template. If it exists, it will send your array of 
variables as GET data using `file_get_contents()`. If no template is selected, or 
the template you specify isn't found, it will use the default.php template. 

#Example
    //Your Request
    Yii::app()->ses->sendEmail("iamcool@yup.com","Test Message",array("title"=>$title, ... ) , "myCoolTemplate");
    //SESCompenent response
    $body = file_get_contents(http:://webroot.com/path_to_templates/myCoolTemplate?title=[evaluation of $title]&[all your other variables...]
