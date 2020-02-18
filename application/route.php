<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

Route::rule('banner','api/Banner/swip');
Route::rule('news','api/News/lst');
Route::rule('user','api/User/add');
Route::rule('article','api/Article/lst');
Route::rule('detail','api/Detail/detail');
Route::rule('cate','api/Cate/lst');
Route::rule('square','api/Square/lst');
Route::rule('follow','api/Follow/lst');
Route::rule('follow_num','api/Follow/foll');
Route::rule('follow_pass','api/Follow/pass');
Route::rule('uploadimg','api/Uploadimg/lst');
Route::rule('user_edit','api/User/edit');
Route::rule('user_lst','api/User/lst');
Route::rule('test','api/Test/lst');
Route::rule('exam','api/User/exam');
Route::rule('aaa','api/Aaa/codd');