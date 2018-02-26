<?php
/**
 * 常量库
 *
 * Created by PhpStorm.
 * User: linxingchen_iwm
 * Date: 2017/1/27
 * Time: 23:00
 */
class CoreConst{
    //平台常量
    const PLATFORM_TEST     = -1;
    const PLATFORM_UNKNOWN  = 0;
    const PLATFORM_ADMIN    = 1;
    const PLATFORM_PC       = 2;
    const PLATFORM_MOBILE   = 3;

    public static $platform = [
        self::PLATFORM_TEST,
        self::PLATFORM_ADMIN,
        self::PLATFORM_PC,
        self::PLATFORM_MOBILE,
    ];

    //UUID
    const LOG_UUID    = 'uuid:log';
    const USER_UUID   = 'uuid:user';
    public static $uuid = [
        self::LOG_UUID,
        self::USER_UUID,
    ];

    //状态
    const STATUS_INVALID    = 0;
    const STATUS_VALID      = 1;
    const STATUS_FREEZE     = 2;

    //模块列表，用于打LOG等
    const MODULE_DEFAULT = 'default';
    const MODULE_KERNEL  = 'kernel';
    const MODULE_ACCOUNT = 'account';
    const MODULE_DATABASE  = 'database';
    const MODULE_WEBSOCKET = 'websocket';
    const MODULE_SAL     = 'SAL';
    const MODULE_EMAIL   = 'EMAIL';
    const MODULE_BOS     = 'BOS';
    const MODULE_MESSAGE = 'message';
    const MODULE_THIRD_BDVOICE = 'BdVoice';
    const MODULE_THIRD_ALISMS  = 'ALISMS';

    public static $moduleList = [
        self::MODULE_ACCOUNT,
        self::MODULE_KERNEL,
        self::MODULE_DATABASE,
        self::MODULE_WEBSOCKET,
        self::MODULE_SAL,
        self::MODULE_EMAIL,
        self::MODULE_BOS,
        self::MODULE_MESSAGE,
        self::MODULE_THIRD_BDVOICE,
        self::MODULE_THIRD_ALISMS,
    ];

    //log是否打开
//    const LOG_SWITCH = 0;
    const LOG_SWITCH  = 1;

}