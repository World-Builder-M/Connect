<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'serial_number',
        'status',
        'organisation_id',
        'department_id',
        'employee_id',
    ];

    public const TYPE_BIKE = 'bike';
    public const TYPE_CAR = 'car';

    public const STATUS_AVAILABLE = 'available';
    public const STATUS_IN_USE = 'in_use';
    public const STATUS_UNDER_MAINTENANCE = 'under_maintenance';

    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public static function getTypeOptions(): array
    {
        return [
            self::TYPE_BIKE => 'Fiets',
            self::TYPE_CAR => 'Auto',
        ];
    }

    public static function getStatusOptions(): array
    {
        return [
            self::STATUS_AVAILABLE => 'Beschikbaar',
            self::STATUS_IN_USE => 'In gebruik',
            self::STATUS_UNDER_MAINTENANCE => 'In onderhoud',
        ];
    }
}
