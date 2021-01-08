<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
      $opciones = array(
        'http'=>array(
          'method'=>"GET",
          'header'=>"Api-Token: 41ddbe8861827f5d6f7de5d0db26012b647662f3f9113c474f278066f0bd5e1b851e382c"
        )
      );

      $contexto = stream_context_create($opciones);        

      try {
        $fichero = file_get_contents('https://partidoelige.api-us1.com/api/3/contacts', false, $contexto);

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
}
