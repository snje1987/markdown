<?php

/*
 * Copyright (C) 2016 Yang Ming <yangming0116@163.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Org\Snje\Markdown\Test;

use Michelf\MarkdownExtra;

/**
 * Description of BookTest
 *
 * @author Yang Ming <yangming0116@163.com>
 */
class TodoList extends \PHPUnit_Framework_TestCase {

    public function test_TodoList() {
        $markdown = new MarkdownExtra();
        $markdown->custom_code_parser = function($class, $code) {
            return '<' . $class . '>' . $code . '</' . $class . '>';
        };

        $tests = [
            ["## aaa\n[] 1111", "<h2>aaa</h2>\n\n<p class=\"todo\"><input type=\"checkbox\" disabled=\"disabled\" />1111</p>"],
            ["[*] 2222", '<p class="todo"><input type="checkbox" disabled="disabled" checked="checked" />2222</p>'],
            ['[+]3333', '<p class="todo"><input type="checkbox" disabled="disabled" checked="checked" />3333</p>'],
            ['[ ]4444[111](https://www.baidu.com)', '<p class="todo"><input type="checkbox" disabled="disabled" />4444<a href="https://www.baidu.com">111</a></p>'],
            ['[-]55`abc`55', '<p class="todo"><input type="checkbox" disabled="disabled" />55<code>abc</code>55</p>'],
            ["## aaa\n() 1111", "<h2>aaa</h2>\n\n<p class=\"todo\"><input type=\"radio\" disabled=\"disabled\" />1111</p>"],
            ["(*) 2222", '<p class="todo"><input type="radio" disabled="disabled" checked="checked" />2222</p>'],
            ['(+)3333', '<p class="todo"><input type="radio" disabled="disabled" checked="checked" />3333</p>'],
            ['( )4444[111](https://www.baidu.com)', '<p class="todo"><input type="radio" disabled="disabled" />4444<a href="https://www.baidu.com">111</a></p>'],
            ['(-)55`abc`55', '<p class="todo"><input type="radio" disabled="disabled" />55<code>abc</code>55</p>'],
        ];

        foreach ($tests as $v) {
            $ret = $markdown->transform($v[0]);
            $this->assertEquals($v[1] . "\n", $ret);
        }
    }

}
