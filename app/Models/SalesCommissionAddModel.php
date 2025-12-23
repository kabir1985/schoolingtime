<?php
 namespace App\Models;
 use CodeIgniter\Model;

class SalesCommissionAddModel extends Model
 {
    protected $table = 'sales_commission';

    protected $primaryKey = 'sales_commission_id';

    protected $allowedFields = ['sales_commission_percent','sales_commission_type'];

 } 