@extends('layouts.app_user')
@section('content')

    <link rel="stylesheet" href="{{ asset('css/contacts.css') }}">
    <script src="{{ asset('js/forms.js') }}"></script>

    <script>
        $(window).load( function(){
            $().UItoTop({ easingType: 'easeOutQuart' });
            $('form').forms({
                ownerEmail:'#'
            });
        });
    </script>
    <div class="content">
        <div class="container_16">
            <div class="row">
                <div class="map_wrapper grid_5 suffix_1">
                    <h2>Contact Info</h2>
                    <iframe id="map_canvas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3194.506131038986!2d10.07167337564545!3d36.80638987224544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12fd2d8c962cf837%3A0xe9d0b929654cf29b!2sSQLI%20Services!5e0!3m2!1sfr!2stn!4v1741432139449!5m2!1sfr!2stn" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </iframe>
                    <dl class="adress">
                        <dt class="color-1">8901 Marmora Road,<br>
                            Glasgow, D04 89GR.</dt>
                        <dd><span>Freephone:</span>+1 800 559 6580</dd>
                        <dd><span>Telephone:</span>+1 800 603 6035</dd>
                        <dd><span>FAX:</span>+1 800 889 9898</dd>
                        <dd><span class="e-mail">E-mail:  <a href="mailto:mail@demolink.org" class="demo color-1">mail@demolink.org</a></span></dd>
                    </dl>
                </div>
                <article class="grid_10">
                    <h2>Get In Touch</h2>
                    <form id="contact-form">
                        <div class="success">Contact form submitted!<br>
                            <strong>We will be in touch soon.</strong>
                        </div>
                        <fieldset>
                            <label class="name">
                                <input type="text" value="Name:">
                                <span class="error">*This is not a valid name.</span>
                                <span class="empty">*This field is required.</span>
                            </label>
                            <label class="email">
                                <input type="email" value="E-mail:">
                                <span class="error">*This is not a valid email address.</span>
                                <span class="empty">*This field is required.</span>
                            </label>
                            <label class="phone">
                                <input type="tel" value="Phone:">
                                <span class="error">*This is not a valid phone number.</span>
                                <span class="empty">*This field is required.</span>
                            </label>
                            <label class="message">
                                <textarea>Message:</textarea>
                                <span class="error">*The message is too short.</span>
                                <span class="empty">*This field is required.</span>
                            </label>
                            <div class="form_buttons">
                                <a href="#" class="btn-2" data-type="reset">Clear</a>
                                <a href="#" class="btn-2" data-type="submit">submit</a>
                            </div>
                        </fieldset>
                    </form>
                </article>
            </div>
        </div>
    </div>
@endsection
