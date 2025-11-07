<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Real Estate Website</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  @include('frontend.layouts.style')
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="{{route('home')}}" class="logo d-flex align-items-center me-auto me-xl-0">

        <h1 class="sitename">TheProperty</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{route('home')}}" class="{{Request::is('/') ? 'active' : ''}} ">Home</a></li>
          <li><a href="{{route('about')}}" class="{{Request::is('about') ? 'active' : ''}}">About</a></li>
          <li><a href="{{route('properties')}}" class="{{Request::is('properties') ? 'active' : ''}}">Properties</a></li>
          <li><a href="{{route('services')}}"  class="{{Request::is('services') ? 'active' : ''}}">Services</a></li>
          <li><a href="{{ route('agents') }}" class="{{Request::is('agents') ? 'active' : ''}}">Agents</a></li>
          <li><a href="{{route('blog')}}"  class="{{Request::is('blog') ? 'active' : ''}}">Blog</a></li>
          <li class="dropdown"><a href="#"><span>More Pages</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="{{route('pricing')}}">Gate Plan</a></li>
              <li><a href="{{ route('terms') }}">Terms</a></li>
              <li><a href="{{ route('privacy') }}">Privacy</a></li>
            </ul>
          </li>
          <li><a href="{{route('contact')}}" class="{{Request::is('contact') ? 'active' : ''}}">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      @if (Auth::guard('web')->check())
          <a class="btn-getstarted" href="{{route('dashboard')}}">Customer Dashboard</a>
      @elseif (Auth::guard('agent')->check())
          <a class="btn-getstarted" href="{{route('agent_dashboard')}}" >Agent Dashboard</a>
      @elseif (Auth::guard('admin')->check())
          <a class="btn-getstarted" href="{{route('admin_dashboard')}}" >Admin Dashboard</a>
      @else
          <a class="btn-getstarted" href="{{route('select_user')}}" >Get Started</a>
      @endif


    </div>
  </header>
