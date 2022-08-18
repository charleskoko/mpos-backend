<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Class UniqueNumber
 *
 * @package App\Models
 * @property string $id
 * @property string $prefix
 * @property int $current
 * @property int $digits
 * @property string $year
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UniqueNumber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UniqueNumber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UniqueNumber query()
 */
class UniqueNumber extends Model
{
    use Uuids;

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['prefix', 'current', 'digits', 'year', 'user_id'];

    protected $attributes = [
        'current' => self::DEFAULT_VALUE,
    ];

    public const DEFAULT_DIGITS = 5;
    public const DEFAULT_VALUE = 0;

    /**
     * @param object $model
     * @param int $format
     *
     * @return string|null
     */
    public static function predictedNumber(object $model, int $format): ?string
    {
        $prefix = strtoupper(substr(class_basename($model), 0, 3));

        $year = date('Y');

        $number = self::where('prefix', $prefix)->where('year', $year)->where('user_id', Auth::id())->first();

        $currentNumber = (string) (($number->current ?? 0) + 1);
        $zeroFilledNumber = str_pad($currentNumber, self::DEFAULT_DIGITS, '0', STR_PAD_LEFT);

        switch ($format) {
            case 1:
                return $zeroFilledNumber;
            case 2:
                return $year . '-' . $zeroFilledNumber;
            case 3:
                return $prefix . $year . '-' . $zeroFilledNumber;
        }
        return null;
    }

    /**
     * @param object $model
     * @param int $format
     *
     * @return string|null
     */
    public static function generateNumber(string $model, int $format = 3): ?string
    {
        $prefix = strtoupper(substr($model, 0, 3));

        $year = date('Y');

        $number = self::where('prefix', $prefix)->where('year', $year)->where('user_id',Auth::id())->first();

        if (empty($number)) {
            $number = new self([
                'prefix' => $prefix,
                'year' => $year,
                'user_id' => Auth::id(),
                'digits' => self::DEFAULT_DIGITS,
                'current' => self::DEFAULT_VALUE,
            ]);
            $number->save();
        }

        $number->update(['current' => $number->current +1]);

        $currentNumber = (string) $number->current;
        $zeroFilledNumber = str_pad($currentNumber, self::DEFAULT_DIGITS, '0', STR_PAD_LEFT);

        switch ($format) {
            case 1:
                return $zeroFilledNumber;
            case 2:
                return $year . '-' . $zeroFilledNumber;
            case 3:
                return $prefix . $year . '-' . $zeroFilledNumber;
        }
        return null;
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
