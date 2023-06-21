{{-- THIS CONTACT FORM MUST BE INCLUDED WITH layout.blade.php
    OR INCLUDE css/LCLbootstrap.css (I have no idea why regular
    Bootstrap doesn't work) --}}
<section style="padding: 5em 0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="wrapper" id="contacternous">
                    <div class="row no-gutters">
                        <div class="col-md-7">
                            <div class="contact-wrap w-100 p-md-5 p-4">
                                <h3 class="mb-4">Des questions? Contactez nous!</h3>
                                <form method="POST" action="contactus" id="contactForm" name="contactForm"
                                    class="contactForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="full_name">Nom et Pr&eacute;nom</label>
                                                <input type="text" class="form-control" name="full_name"
                                                    id="name" placeholder="Nom" value="{{ old('full_name') }}">
                                                @error('full_name')
                                                    <p class="text-red-500 text-xs mb-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="email">Adresse Email</label>
                                                <input type="email" class="form-control" name="email" id="email"
                                                    placeholder="Email" value="{{ old('email') }}">
                                                @error('email')
                                                    <p class="text-red-500 text-xs mb-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="objet">Objet</label>
                                                <input type="text" class="form-control" name="objet" id="subject"
                                                    placeholder="Objet" value="{{ old('objet') }}">
                                                @error('objet')
                                                    <p class="text-red-500 text-xs mb-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="message">Message</label>
                                                <textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Message">{{ old('message') }}</textarea>
                                                @error('message')
                                                    <p class="text-red-500 text-xs mb-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="submit" value="Envoyer" class="btn btn-primary">
                                                <div class="submitting"></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-5 d-flex align-items-stretch">
                            <div class="info-wrap w-100 p-5 img" style="background-image: url(images/prov.jpeg);">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-map-marker"></span>
                                </div>
                                <div class="text">
                                    <p><span>Address:</span> Si&egrave;ge de Province de Sidi Slimane. Pr&egrave;s du
                                        Tribunal de Premi&egrave;re Instance.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-phone"></span>
                                </div>
                                <div class="text">
                                    <p><span>Num&eacute;ro de Telephone:</span> <a href="tel://0537502953">05 37 50 29
                                            53</a></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-paper-plane"></span>
                                </div>
                                <div class="text">
                                    <p><span>Email:</span> <a
                                            href="mailto:contact@provincesidislimane.ma">contact@provincesidislimane.ma</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="dbox w-100 text-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-globe"></span>
                                </div>
                                <div class="text">
                                    <p><span>Site Web:</span> <a href="http://www.provincesidislimane.ma"
                                            target="_blank">www.provincesidislimane.ma</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
