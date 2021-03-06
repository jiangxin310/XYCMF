<?php
/*
 * @package [App\Models\User]
 * @author [李志刚]
 * @createdate  [2018-06-26]
 * @copyright [2018-2020 衡水希夷信息技术工作室]
 * @version [1.0.0]
 * @directions 用户
 *
 */
namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // 用户表
    /**
     * 关联到模型的数据表
     *
     * @var string
     */
    protected $table = 'users';

    // 不可以批量赋值的字段，为空则表示都可以
    protected $guarded = [];

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $hidden = [];

    /**
     * 表明模型是否应该被打上时间戳
     *
     * @var bool
     */
    public $timestamps = true;

    // 增加会员等级的属性
    protected $appends = ['groupname'];

    public function getGroupnameAttribute()
    {
        $points = $this->attributes['points'];
        try {
            $groups = collect(cache('group'))->sortByDesc('points');
            $groupname = $groups->where('points','<=',$points)->first()['name'];
        } catch (\Throwable $e) {
            $groupname = '普通用户';
        }
        return $groupname;
    }


}
