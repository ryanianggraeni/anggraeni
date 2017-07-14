<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
class Book extends Model
{
    public static function boot()
    {
        parent::boot();
        self::updating(function($book)
        {
            if ($book->amount<$book->borrowed)
            {
                Session::flash("flash_notification", [
                "level"=>"danger",
                "message"=>"Jumlah Buku $book->title Harus >= ".$book->borrowed]);
                return false;
            }
        });
        self::deleting(function($book)
        {
            if ($book->borrowlogs()->count()>0)
            {
                Session::flash("flash_notification", [
                "level"=>"danger",
                "message"=>"Buku $book->title Sedang Dipinjam"]);
                return false;
            }
        });
    }
    public function getBorrowedAttribute()
    {
        return $this->borrowlogs()->borrowed()->count();
    }
    protected $fillable=['title','author_id','amount'];
    public function author()
    {
        return $this->belongsTo('App\Author');
    }
    public function borrowlogs()
    {
        return $this->hasMany('App\borrowLog');
    }
    public function getStockAttribute()
    {
        $borrowed = $this->borrowlogs()->borrowed()->count();
        $stock = $this->amount - $borrowed;
        return $stock;
    }
}