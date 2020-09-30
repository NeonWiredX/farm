<?php


namespace Farm\Infrastructure;


interface IDatabase
{

    public function query(string $request,array $placeholders = []):array;

    public function exec(string $request,array $placeholders = []);

}