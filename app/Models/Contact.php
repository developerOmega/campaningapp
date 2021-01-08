<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
      "email",
      "phone",
      "firstName",
      "lastName",
      "orgid",
      "orgname",
      "bounced_hard",
      "bounced_soft",
      "bounced_date",
      "ip",
      "ua",
      "hash",
      "socialdata_lastcheck",
      "email_local",
      "email_domain",
      "sentcnt",
      "rating_tstamp",
      "gravatar",
      "deleted",
      "anonymized",
      "organization",
      "cdate",
      "adate",
      "udate",
      "edate",
      "created_utc_timestamp",
      "updated_utc_timestamp",
    ];

    public static function setContactsByApi() {

      $apiURL = env('API_CAMPANING_URL', null);
      $apiKey = env('API_KEY_CAMPANING', null);

      
      $opciones = array(
      'http'=>array(
        'method'=>"GET",
        'header'=>"Api-Token: $apiKey"
        )
      );  
      $contexto = stream_context_create($opciones);        

      try {
        $fichero = file_get_contents("$apiURL/api/3/contacts", false, $contexto);
        $data = json_decode($fichero, true);

        for($i = 0; $i < count($data["contacts"]); $i++){
          Contact::create([
            "email" => $data["contacts"][$i]["email"],
            "phone" => $data["contacts"][$i]["phone"],
            "firstName" => $data["contacts"][$i]["firstName"],
            "lastName" => $data["contacts"][$i]["lastName"],
            "orgid" => $data["contacts"][$i]["orgid"],
            "orgname" => $data["contacts"][$i]["orgname"],
            "bounced_hard" => $data["contacts"][$i]["bounced_hard"],
            "bounced_soft" => $data["contacts"][$i]["bounced_soft"],
            "bounced_date" => $data["contacts"][$i]["bounced_date"],
            "ip" => $data["contacts"][$i]["ip"],
            "ua" => $data["contacts"][$i]["ua"],
            "hash" => $data["contacts"][$i]["hash"],
            "socialdata_lastcheck" => $data["contacts"][$i]["socialdata_lastcheck"],
            "email_local" => $data["contacts"][$i]["email_local"],
            "email_domain" => $data["contacts"][$i]["email_domain"],
            "sentcnt" => $data["contacts"][$i]["sentcnt"],
            "rating_tstamp" => $data["contacts"][$i]["rating_tstamp"],
            "gravatar" => $data["contacts"][$i]["gravatar"],
            "deleted" => $data["contacts"][$i]["deleted"],
            "anonymized" => $data["contacts"][$i]["anonymized"],
            "organization" => $data["contacts"][$i]["organization"],
            "cdate" => $data["contacts"][$i]["cdate"],
            "adate" => $data["contacts"][$i]["adate"],
            "udate" => $data["contacts"][$i]["udate"],
            "edate" => $data["contacts"][$i]["edate"],
            "created_utc_timestamp" => $data["contacts"][$i]["created_utc_timestamp"],
            "updated_utc_timestamp" => $data["contacts"][$i]["updated_utc_timestamp"],
          ]);
        }
        

        return "Fine";

      } catch (\Throwable $th) {
        return $th;
      }
    }

    public static function makeQuery($name, $data) {

      $query = "CREATE TABLE IF NOT EXISTS $name ( id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY, ";
  
      foreach($data as $name=>$prop){
  
        $type = empty($prop['type']) ? $prop : $prop['type'];
  
        $default = empty($prop['default']) ?  " \" \" " : 
          ( $prop['default'] == "null" ? $prop['default'] : "\"" . $prop['default'] . "\"" );
  
        $query .= "$name $type(255) DEFAULT $default, ";
      }
  
      $query .= "updated_at TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(), created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)";

      return $query;
    }

    public static function makeDB( $name, $data ){

      try {
        $name_dt = date("Ymd") . $name;
        $query = Contact::makeQuery( $name_dt, $data );

        $pdo = DB::connection()->getPdo();

        $pdo->exec($query);
        return "CREATE $name_dt TABLE";
      } catch (\Throwable $th) {
        throw $th;
      }

    }

    public static function exp(){

      return "Estas son comillas dobles:  \" Daniel \" "; 
    }



}
