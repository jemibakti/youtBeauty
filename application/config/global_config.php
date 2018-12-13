<?php  if (!defined("BASEPATH")) exit("No direct script access allowed");

$config = array();
define("SITENAME", "Grumma");
define("TOKO", "Grumma.com");

define("PATH_EXTRA", "/");
define("STRIPTAGS", "<p><a><ul><ol><li>");

define("ASSET", "mtcp_assets/");
define("JS_ASSET", ASSET."js/");
define("CSS_ASSET", ASSET."css/");
define("IMG_ASSET", ASSET."images/");

define("MSG_SAVEDATA", "Data has been saved");
define("MSG_FAILEDSAVEDATA", "Failed to save the data");
define("MSG_UPDATEDATA", "Data has been updated");
define("MSG_FAILEDUPDATEDATA", "Failed to update the data");
define("MSG_DELETEDATA", "Data has been deleted");
define("MSG_CANCELDATA", "Data has been cancelled");
define("MSG_FAILEDCANCELDATA", "Failed to cancel the data");
define("MSG_DELETEDATAPARTIAL", "Data partially has been deleted");
define("MSG_FAILEDDELETEDATA", "Failed to delete the data");
define("MSG_ALREADYEXISTS", "Data already exists, action has been canceled.");
define("MSG_CANNOTCREATEFOLDER", "Data cannot be saved, because the folder cannot be created !");
define("MSG_CANNOTCREATEFOLDERUPDATE", "Data cannot be updated, because the folder cannot be created !");
define("MSG_FAILEDSAVEDATAUPLOAD", "Document cannot be saved, The attachment cannot be saved");
define("MSG_FAILEDUPLOAD", "Attachment failed to be uploaded !");
define("TIPS_DELETEFILE", "Check the file(s) and click <b>Update</b> button to delete.");
define("MSG_LOGIN_USERNAMENOTVALID", "Please enter a valid username");
define("MSG_LOGIN_PASSWORDNOTVALID", "Please enter a valid password");
define("MSG_LOGIN_USERNAMENOTACTIVE", "Member not active");
define("MSG_FAILEDSUBMITDATA_ALREADYEXISTS", "Failed to submit the data, because it's already exists ! ");
define("MSG_FAILEDDELETEDATA_STILLUSED", "Failed to delete the data, because this data is still used ! ");
define("MSG_FAILEDCANCELDATA_STILLUSED", "Failed to cancel the data, because this data is still used ! ");
define("MSG_FAILEDDELETEDATA_ALREADYDELETE", "Failed to delete the data, because this data is already been deleted ! ");
define("MSG_YOUARENOTAUTHORIZE_ACTION", "You are not authorize to process this action");

# TABLE
define("mast", "m_");
define("trx", "trx_");
define("M_CUST", mast."customer");
define("TRX_ALAMAT", trx."alamat");
define("TRX_BELI", trx."pembelian");


define("INV_NEW", 1);
define("INV_OPEN", 5);
define("INV_HALFPAID", 7);
define("INV_PAID", 10);
define("MAX_RECIPIENT", 10);
define("SCH_DATE_RANGE", 5); ###  +5 and -5