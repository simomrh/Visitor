@extends('layouts.app')


<div class="container">
<form method="post" action="{{url('/store_departement')}}">
@csrf

    <div class="form-group">
    <label for="exampleFormControlInput1">Nom départemnt</label>
      <input type="text" class="form-control" id="exampleFormControlInput1" name="nom_departement">
    </div>
    <div class="form-group">
    <label for="exampleFormControlInput1">Créer par</label>
      <input type="text" class="form-control" id="exampleFormControlInput1" name="user_cr">
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect1">Créer en</label>
      <input type="date" class="form-control" id="exampleFormControlInput1" name="date_cr">
    </div>

      <button  type="submit" class="btn btn-outline-success nav_name " style="margin-top= 10%">
        <i class='bx bx-user nav_icon'></i> <span class="nav_name"> Submit</span>
      </button>
  </form>
</div>
