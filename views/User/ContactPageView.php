<?php
require_once($_SERVER['DOCUMENT_ROOT'] . './Project/views/User/LayoutView.php');

class ContactPageView extends LayoutView
{
    
    public function showContactInfos()
    {
        ?>
        <div class="contact" >
            <div>
                <h1>GET IN TOUCH</h1>
                <p>BOUKEF Ahmed Rami</p>
                <p>Alger, Algeria</p>
                <a href="mailto:ka_boukef@esi.dz">ka_boukef@esi.dz</a>
                <a href="tel:+213541859790">+213 5 41 85 97 90</a>
                <div class="social">
                    <?php $this->showSocialMedia(); ?>
                </div>
            </div>
            <form id="contactForm">
                <div>
                    <input type="text" name="subject" id="subject" placeholder="Subject" required>
                </div>
                <div>
                    <textarea name="message" id="message" cols="30" rows="10" placeholder="Your message" required></textarea>
                </div>
                <div>
                    <input type="submit" value="Send Mail">
                </div>
            </form>
        </div>
        <div class="toast align-items-center text-bg-primary border-0" id="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    Message sent successfuly.
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            </div>
        <?php
        
    }

    public function showContactPage()
    {
        $this->showHeader();
        $this->showMenu();
        $this->showContactInfos();
        $this->showFooter();
    }
}
