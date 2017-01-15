@extends('layouts.app')

@section('content')
<!-- Main -->
<div id="main" class="wrapper style1">
    <div class="container">
        <header class="major">
            <h2>Dashboard</h2>
            <p>Ipsum dolor feugiat aliquam tempus sed magna lorem consequat accumsan</p>
        </header>

<!-- Content -->
        <section id="content">
            <passport-clients></passport-clients>
            <passport-authorized-clients></passport-authorized-clients>
            <passport-personal-access-tokens></passport-personal-access-tokens>
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

        </section>
    </div>
</div>
@endsection
