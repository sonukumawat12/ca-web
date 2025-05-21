<template>
  <footer class="footer-section">
    <div class="footer-main">
      <div class="footer-cols">
        <!-- Contact -->
        <div class="footer-col">
          <div class="footer-col-title">Contact Us</div>
          <ul class="footer-contact-list">
            <li>
              <div class="contact-icon"><i class="bi bi-geo-alt"></i></div>
              <div class="contact-text">D-82-B, Krishna, Siwar Area, Bapu Nagar, Jaipur, Rajasthan 302015</div>
            </li>
            <li>
              <div class="contact-icon"><i class="bi bi-telephone"></i></div>
              <div class="contact-text">+91 9314507298</div>
            </li>
            <li>
              <div class="contact-icon"><i class="bi bi-envelope"></i></div>
              <div class="contact-text">PooniaandSoni@gmail.com</div>
            </li>
          </ul>
        </div>
        <!-- Useful Links -->
        <div class="footer-col">
          <div class="footer-col-title">Quick Links</div>
          <ul class="footer-link-list">
            <li><a href="/"><i class="bi bi-chevron-right"></i>Home</a></li>
            <li><a href="/about"><i class="bi bi-chevron-right"></i>About</a></li>
            <li><a href="/services"><i class="bi bi-chevron-right"></i>Services</a></li>
            <li><a href="/terms"><i class="bi bi-chevron-right"></i>Terms of Service</a></li>
            <li><a href="/privacy"><i class="bi bi-chevron-right"></i>Privacy Policy</a></li>
          </ul>
        </div>
        <!-- Our Services -->
        <div class="footer-col">
          <div class="footer-col-title">Our Services</div>
          <ul class="footer-link-list">
            <li><i class="bi bi-check2-circle"></i>Income Tax Filing</li>
            <li><i class="bi bi-check2-circle"></i>GST Registration & Filing</li>
            <li><i class="bi bi-check2-circle"></i>Company Registration</li>
            <li><i class="bi bi-check2-circle"></i>Audit & Assurance</li>
            <li><i class="bi bi-check2-circle"></i>Business Consulting</li>
          </ul>
        </div>
      </div>
      <!-- Service Stats -->
      <div class="footer-stats">
        <div class="footer-stat">
          <div class="stat-icon"><i class="bi bi-shield-check"></i></div>
          <div class="stat-content">
            <div class="stat-title">ICAI Registered</div>
            <div class="stat-subtitle">Certified Professionals</div>
          </div>
        </div>
        <div class="footer-stat">
          <div class="stat-icon"><i class="bi bi-award"></i></div>
          <div class="stat-content">
            <div class="stat-title">15+ Years</div>
            <div class="stat-subtitle">Experience</div>
          </div>
        </div>
        <div class="footer-stat">
          <div class="stat-icon"><i class="bi bi-people"></i></div>
          <div class="stat-content">
            <div class="stat-title">1000+</div>
            <div class="stat-subtitle">Happy Clients</div>
          </div>
        </div>
        <div class="footer-stat">
          <div class="stat-icon"><i class="bi bi-clock-history"></i></div>
          <div class="stat-content">
            <div class="stat-title">24/7</div>
            <div class="stat-subtitle">Support</div>
          </div>
        </div>
      </div>
      <hr class="footer-divider" />
      <!-- Copyright & Legal -->
      <div class="footer-copyright">
        <div class="copyright-text">
          © 2025 Poonia & Soni Chartered Accountants. All rights reserved.
        </div>
        <div class="footer-legal-links">
          <a href="/privacy">Privacy Policy</a>
          <span class="divider">|</span>
          <a href="/terms">Terms & Conditions</a>
        </div>
      </div>
    </div>
    <!-- Bottom Bar -->
    <div class="footer-bottom-bar">
      <div class="footer-bottom-support">
        <i class="bi bi-telephone"></i>
        <span>24/7 Support: +91 9314507298</span>
      </div>
      <div class="footer-bottom-links">
        <a href="https://wa.me/919314507298" target="_blank" rel="noopener" class="footer-bottom-link">
          <i class="bi bi-whatsapp"></i>
          <span>WhatsApp</span>
        </a>
        <a href="mailto:PooniaandSoni@gmail.com" class="footer-bottom-link">
          <i class="bi bi-envelope"></i>
          <span>Email</span>
        </a>
      </div>
      <div class="footer-bottom-made">
        Made with <span class="heart">❤</span> by
        <a href="https://emayainfotech.com" target="_blank" rel="noopener">Emaya Infotech</a>
      </div>
    </div>
  </footer>
</template>

<style scoped>
.footer-section {
  background: linear-gradient(to bottom, #ffffff, #f8fafc);
  color: #1a1a1a;
  font-family: var(--font-body);
  font-size: 16px;
  margin-top: 48px;
  box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.05);
}

.footer-main {
  max-width: 1200px;
  margin: 0 auto;
  padding: 64px 24px 0 24px;
}

.footer-cols {
  display: flex;
  gap: 64px;
  justify-content: space-between;
  flex-wrap: wrap;
}

.footer-col {
  flex: 1 1 280px;
  min-width: 280px;
  margin-bottom: 40px;
}

.footer-col-title {
  font-family: var(--font-heading);
  font-weight: 700;
  font-size: 22px;
  margin-bottom: 24px;
  color: #1a1a1a;
  position: relative;
  padding-bottom: 12px;
}

.footer-col-title::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 40px;
  height: 3px;
  background: #7C3AED;
  border-radius: 2px;
}

.footer-contact-list,
.footer-link-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.footer-contact-list li {
  margin-bottom: 16px;
  display: flex;
  align-items: flex-start;
  gap: 12px;
}

.contact-icon {
  color: #7C3AED;
  font-size: 20px;
  margin-top: 2px;
}

.contact-text {
  color: #4a5568;
  line-height: 1.5;
}

.footer-link-list li {
  margin-bottom: 12px;
  display: flex;
  align-items: center;
  gap: 8px;
}

.footer-link-list i {
  color: #7C3AED;
  font-size: 16px;
}

.footer-link-list a {
  color: #4a5568;
  text-decoration: none;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 8px;
}

.footer-link-list a:hover {
  color: #7C3AED;
  transform: translateX(4px);
}

.footer-stats {
  display: flex;
  justify-content: space-between;
  gap: 32px;
  margin: 48px 0 32px 0;
  flex-wrap: wrap;
  background: #ffffff;
  padding: 32px;
  border-radius: 12px;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
}

.footer-stat {
  display: flex;
  align-items: center;
  gap: 16px;
  flex: 1;
  min-width: 200px;
}

.stat-icon {
  background: #f3e8ff;
  color: #7C3AED;
  width: 48px;
  height: 48px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
}

.stat-content {
  display: flex;
  flex-direction: column;
}

.stat-title {
  font-weight: 700;
  font-size: 20px;
  color: #1a1a1a;
}

.stat-subtitle {
  font-size: 14px;
  color: #4a5568;
}

.footer-divider {
  border: none;
  border-top: 1px solid #e2e8f0;
  margin: 32px 0 24px 0;
}

.footer-copyright {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  padding: 24px 0;
  gap: 16px;
}

.copyright-text {
  color: #4a5568;
  font-size: 15px;
}

.footer-legal-links {
  display: flex;
  align-items: center;
  gap: 8px;
}

.footer-legal-links a {
  color: #4a5568;
  text-decoration: none;
  font-size: 15px;
  transition: color 0.3s ease;
}

.footer-legal-links a:hover {
  color: #7C3AED;
}

.divider {
  color: #cbd5e0;
}

.footer-bottom-bar {
  background: linear-gradient(to right, #7C3AED, #6236d1);
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 20px 32px;
  font-size: 16px;
  flex-wrap: wrap;
  gap: 16px;
}

.footer-bottom-support {
  display: flex;
  align-items: center;
  gap: 12px;
  font-weight: 500;
}

.footer-bottom-support i {
  font-size: 20px;
}

.footer-bottom-links {
  display: flex;
  align-items: center;
  gap: 24px;
}

.footer-bottom-link {
  color: #fff;
  text-decoration: none;
  display: flex;
  align-items: center;
  gap: 8px;
  transition: all 0.3s ease;
  padding: 8px 16px;
  border-radius: 8px;
  background: rgba(255, 255, 255, 0.1);
}

.footer-bottom-link:hover {
  background: rgba(255, 255, 255, 0.2);
  transform: translateY(-2px);
}

.footer-bottom-made {
  font-size: 15px;
  color: rgba(255, 255, 255, 0.8);
}

.heart {
  color: #fc4623;
  animation: heartbeat 1.5s ease-in-out infinite;
}

.footer-bottom-made a {
  color: #fff;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.3s ease;
}

.footer-bottom-made a:hover {
  color: #fc4623;
}

@keyframes heartbeat {
  0% { transform: scale(1); }
  50% { transform: scale(1.1); }
  100% { transform: scale(1); }
}

@media (max-width: 1024px) {
  .footer-cols {
    gap: 48px;
  }

  .footer-stats {
    gap: 24px;
  }
}

@media (max-width: 768px) {
  .footer-main {
    padding: 48px 16px 0 16px;
  }

  .footer-cols {
    flex-direction: column;
    gap: 32px;
  }

  .footer-col {
    min-width: 100%;
  }

  .footer-stats {
    flex-direction: column;
    padding: 24px;
  }

  .footer-stat {
    width: 100%;
  }

  .footer-bottom-bar {
    flex-direction: column;
    align-items: flex-start;
    padding: 24px 16px;
  }

  .footer-copyright {
    flex-direction: column;
    align-items: flex-start;
  }
}

@media (max-width: 480px) {
  .footer-section {
    font-size: 14px;
  }

  .footer-col-title {
    font-size: 20px;
  }

  .footer-main {
    padding: 32px 12px 0 12px;
  }

  .footer-bottom-bar {
    font-size: 14px;
    padding: 20px 12px;
  }

  .footer-bottom-link {
    padding: 6px 12px;
  }

  .stat-title {
    font-size: 18px;
  }
}
</style>
