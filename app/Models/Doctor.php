<?php

namespace FluentPlugin\App\Models;

use FluentPlugin\App\Models\Model;

class Doctor 
{
    protected static $table = 'doctors';

    public static function create($data)
    {
        global $wpdb;
        $table = $wpdb->prefix. static::$table;
        $wpdb->insert($table,$data);
    }

    public function all()
    {
        global $wpdb;
        $table = $wpdb->prefix. static::$table;
        return $wpdb->get_results("SELECT * FROM $table");
    }

    public static function find($id)
    {
        global $wpdb;
        $table= $wpdb->prefix. static::$table;
        return $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE doctor_id=%d", $id));
    }

    public static function update($id, $data)
    {
        global $wpdb;
        $table = $wpdb->prefix. static::$table;
        $wpdb->update($table,$data,['doctor_id'=>$id]);
    }

    public static function delete($id)
    {
        global $wpdb;
        $table= $wpdb->prefix. static::$table;
        $wpdb->delete($table, ['doctor_id'=>$id]);
    }
    public static function details($id)
    {
        $doctor=self::find($id);

        if(!$doctor)
        {
            return 'Doctor not found.';
        }

        $details = "Doctor Details:\n";
        $details .= "Name: {$doctor->name}\n";
        $details .= "Email: {$doctor->email}\n";
        $details .= "Specialty: {$doctor->specialty}\n";
        $details .= "Contact Info: {$doctor->contact_info}\n";
        $details .= "Created At: {$doctor->created_at}\n";
        $details .= "Updated At: {$doctor->updated_at}\n";

        return nl2br($details);
    }

    public static function filterBySpeciality($speciality)
    {
        global $wpdb;
        $table = $wpdb->prefix. static::$table;
        return $wpdb->get_results($wpdb->prepare("SELECT * FROM $table WHERE speciality=%s",$speciality));
    }
}