@extends('app')


@if( Auth::user()->type  == 1)
	@include('admin/admin')
@else
	@include('client/client')
@endif

