<?php

namespace App\Http\Controllers\Inventory\Admin;

use App\Http\Controllers\Inventory\BaseController as GuestBaseController;

/**
 * ������� ���������� ��� ��� ����������� ��������� � ������.
 * �� ���� ������� ��� ��� ����������� ���������.
 * 
 * @package App\Http\Controllers\Inventory\Admin
 */
abstract class BaseController extends GuestBaseController
{
    /**
     * BaseController constructor
     */
    public function __construct()
    {
        //����������� ��������� �������� ������
    }
}
