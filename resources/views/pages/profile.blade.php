@extends('layouts.app')

@section('content')

			<!-- Main -->
				<div id="main" class="wrapper style1">
					<div class="container">
						<header class="major">
							<h2>My Profile</h2>
						</header>
						<div class="row 150%">
							<div class="4u 12u$(medium)">

								<!-- Sidebar -->
									<section id="sidebar">
										<section>
                                            <a href="#" class="image fit"><img src="/images/users/{{$picture}}" alt="" /></a>
										</section>
									</section>

							</div>
							<div class="8u$ 12u$(medium) important(medium)">
								<!-- Content -->
									<section id="content">
                                        <table border="1">
                                        <tr>
                                        <td>Name</td>
                                        <td>{{$name}}</td>
                                        </tr>
                                        <tr>
                                        <td>Email</td>
                                        <td>{{$email}}</td>
                                        </tr>
                                        <tr>
                                        <td>Role</td>
                                        <td>{{$roles}}</td>
                                        </tr>
                                        </table>
									</section>

							</div>
						</div>
					</div>
				</div>

@endsection
