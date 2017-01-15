@extends('layouts.app')

@section('content')
<!-- Banner -->
<section id="banner">
    <div class="content">
        <header>
            <h2>The future of disaster recovery is here.</h2>
            <p>It is easy to fall into chaos during a disaster.<br />
            Crisis Guard is here to help.</p>
        </header>
        <span class="image"><img src="images/symbol.svg" alt="" /></span>
    </div>
    <a href="#one" class="goto-next scrolly">Next</a>
</section>
<!-- One -->
    <section id="one" class="spotlight style1 bottom">
        <span class="image fit main"><img src="images/boat.jpg" alt="" /></span>
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="4u 12u$(medium)">
                        <header>
                            <h2>What is Crisis Guard?</h2>
                            <p>In short- the future of rescue.</p>
                        </header>
                    </div>
                    <div class="4u 12u$(medium)">
                        <p>Crisis Guard is the next step in using 21st century technology
                        to ensure a brigher and safer future. By taking advantage of
                        advances in portable electronics, we can offer a product that
                        works to ensure that emergency service are avaialible when you need them,
                        should the need ever arise.</p>
                    </div>
                    <div class="4u$ 12u$(medium)">
                        <p>Over the last few years there have been many disasters and crises
                         where people have turned to the Internet for help. This project
                         aims to assist people in need receive the attention they need.</p>
                    </div>
                </div>
            </div>
        </div>
        <a href="#two" class="goto-next scrolly">Next</a>
    </section>

<!-- Two -->
    <section id="two" class="spotlight style2 right">
        <span class="image fit main"><img src="images/map.png" alt="" /></span>
        <div class="content">
            <header>
                <h2>When disaster strikes, send up a flare.</h2>
                <p>Your location is instantly adding to our central
                     safeguard map, ensuring that your need is noticed quickly.</p>
            </header>
        </div>
        <a href="#three" class="goto-next scrolly">Next</a>
    </section>

<!-- Three -->
    <section id="three" class="spotlight style3 left">
        <span class="image fit main bottom"><img src="images/test.png" alt="" /></span>
        <div class="content">
            <header>
                <h2>Use advanced facial recognition to help find loved ones.</h2>
                <p>Rescuers will run images against photos of the Crisis Guard community
                to identify individuals during rescue missions.</p>
            </header>
        </div>
        <a href="#four" class="goto-next scrolly">Next</a>
    </section>

    <section id="two" class="spotlight style2 right">
        <span class="image fit main"><img src="images/nearby.jpg" alt="" /></span>
        <div class="content">
            <header>
                <h2>Use 'Nearby' technology to find others quickly</h2>
                <p>Use Crisis Guard's Nearby feature to locate others around you
                     quickly and easily.</p>
            </header>
        </div>
        <a href="#three" class="goto-next scrolly">Next</a>
    </section>
<!-- Four -->
<section id="four" class="wrapper style1 special fade-up">
    <div class="container">
        <header class="major">
            <h2>Crisis Guard also helps emergency responders</h2>
            <p>Let the very people you are going to save help you</p>
        </header>
    <div class="box alt">
        <div class="row uniform">
            <section class="4u 6u(medium) 12u$(xsmall)">
                <span class="icon alt major fa-crosshairs"></span>
                <h3>Locate people in need quickly</h3>
                <p>By having all location data collected before even leaving,
                    you can plan the most effective and efficient route possible.</p>
            </section>
            <section class="4u 6u$(medium) 12u$(xsmall)">
                <span class="icon alt major fa-users"></span>
                <h3>Run facial recognition in the field</h3>
                <p>By receiving a response in a matter of seconds versus
                    the hours required by a lab, rescuers in the field can stay more
                    informed than ever.</p>
            </section>
            <section class="4u$ 6u(medium) 12u$(xsmall)">
                <span class="icon alt major fa-sitemap"></span>
                <h3>Stay organized</h3>
                <p>By faciliating through the information provided by Crisis Guard, emergency response
                    teams can feel more confident in their ability to tackle the situation.</p>
            </section>
        </div>
    </div>
    </div>
</section>

@endsection
