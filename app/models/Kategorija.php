<?php

class Kategorija extends \Eloquent {
	protected $fillable = [];
    protected $table = 'kategorijesefova';

    public function sefovi()
    {
        return $this->hasMany("Sef", "idKategorija");
    }
}