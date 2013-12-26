MAG-ImportProd
==================

Introduction 
-------------------------------------------------------------
MAG-ImportProd product import tag Extension for Magento


MAG-ImportProd is a product import tag extension. Admin can upload in bulk product tags. If there are some modifications in this extension and will upload latest release with new version.

Note that while this extension is now considered stable, it is strongly recommended that it be tested on a development/staging site before deploying on a production site.


Features
-------------------------------------------------------------

 1) Admin can import product tag in bulk.
 2) Need to create comma separated CSV(,).
 3) Need to fill CSV in given example CSV.
 

Requirements
-------------------------------------------------------------
 
  Magento Community Edition 1.8+
  Check all php.ini settings(max_execution,max_upload_file,memory_limit).
  
  

Manual Installation
-------------------------------------------------------------

   1)Download Magento extension
   2)Move into target directories   
   3)You will need to login to your admin account, clear Magento's cache, log out, and log back in again.   
   4)In the top menu System -> Import/Export -> Import-Producttag.
   5)You can download Example CSV.
   
Handling Requests  
-------------------------------------------------------------

public function tagAction() 
    {
        // Handle page landing
    }
public function savetagAction()
    {
           // Import all notification.
    }

Support
-------------------------------------------------------------

If you have an issues, please send me an email at "ajaymishra@synsoftglobal.com" and if you still need help, open a bug report in GitHub's issue tracker.

Contributions
-------------------------------------------------------------

This extension is developed by Synsoft Global and his involvement is for further code development and design.


   
