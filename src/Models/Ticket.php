<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Ticket Model
 */
final class Ticket extends Model
{
    protected $connection = 'default';

    protected $table = 'ticket';

    /**
     * [静态方法] 删除不存在的用户的记录
     */
    public static function userIsNull(Ticket $Ticket): void
    {
        $tickets = Ticket::where('userid', $Ticket->userid)->where('rootid', 0)->get();
        foreach ($tickets as $ticket) {
            self::where('rootid', $ticket->id)->delete();
            $ticket->delete();
        }
    }

    /**
     * 时间
     */
    public function datetime(): string
    {
        return date('Y-m-d H:i:s', $this->datetime);
    }

    /**
     * 用户
     */
    public function user(): ?User
    {
        return User::find($this->userid);
    }

    /**
     * 用户名
     */
    public function userName(): string
    {
        if ($this->user() === null) {
            return '用户已不存在';
        }
        return $this->user()->user_name;
    }

    /**
     * 工单状态
     */
    public function status(): string
    {
        return $this->status === 1 ? '开启' : '关闭';
    }
}
