<?php


/**
 * ZBuilder相关设置
 */
return [
    // +----------------------------------------------------------------------
    // | 表格相关设置
    // +----------------------------------------------------------------------

    // 弹出层
    'pop' => [
        'type'       => 2,
        'area'       => ['80%', '90%'],
        'shadeClose' => true,
        'isOutAnim'  => false,
        'anim'       => -1
    ],

    // 右侧按钮
    'right_button' => [
        // 是否显示按钮文字
        'title' => false,
        // 是否显示图标，只有显示文字时才起作用
        'icon'  => true,
        // 按钮大小：xs/sm/lg，留空则为普通大小
        'size' => 'xs',
        // 按钮样式：default/primary/success/info/warning/danger
        'style' => 'default'
    ]
];