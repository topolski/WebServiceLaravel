<?php

class Sef extends \Eloquent {
	protected $fillable = [];
    protected $table = 'sefovi';

    public function kategorija()
    {
        return $this->belongsTo('Kategorija', 'idKategorija');
    }
}