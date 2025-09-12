<footer>
  <div class="footer-title">
    Entre em contato
  </div>
  <div class="footer-subtitle">
    De boas vindas a sua nova versão!
  </div>
  <div class="footer-blocks">
    <!-- E-mail -->
    <div class="footer-block email">
      <img src="https://img.icons8.com/ios-filled/36/paper-plane.png" alt="Enviar" style="margin-bottom:10px;">
      <div>psicanalistafabiolopes@gmail.com</div>
    </div>
    <!-- Telefone -->
    <div class="footer-block telefone">
      <img src="https://img.icons8.com/ios-filled/36/ffffff/phone.png" alt="Telefone" style="margin-bottom:10px;">
      <div>+55 11 998153681</div>
    </div>
    <!-- WhatsApp -->
    <div class="footer-block consulta">
      <img src="https://img.icons8.com/ios-filled/36/ffffff/whatsapp.png" alt="WhatsApp" style="margin-bottom:10px;">
      <div><a href="https://wa.me/5511998153681" target="_blank">Ir para o Whatsapp</a></div>
      <div style="margin-top:10px;">Agende sua consulta</div>
    </div>
  </div>
</footer>

<style>
footer {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 40px 0;
  background: transparent;
}

.footer-title {
  font-family: 'Montserrat', sans-serif;
  font-size: 46px;
  line-height: normal;
  text-align: center;
  color: #142b51;
  margin-bottom: 10px;
  font-weight: normal;
}

.footer-subtitle {
  font-family: 'Montserrat', sans-serif;
  font-size: 20px;
  line-height: 1.2em;
  text-align: center;
  color: #142b51;
  margin-bottom: 30px;
}

.footer-blocks {
  display: flex;
  justify-content: center;
  width: 100%;
}

.footer-block {
  width: 334px;
  height: 360px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  text-align: center;
  font-size: 18px;
  padding: 20px;
  box-sizing: border-box;
  flex-shrink: 0;
}

.footer-block.email { background-color: #f0f1f1; color: #000; }
.footer-block.telefone { background-color: #152b50; color: #fff; }
.footer-block.consulta { background-color: #010100; color: #fff; }
.footer-block.consulta a { color: inherit; text-decoration: underline; }

.footer-blocks .footer-block:first-child { margin-left: 25%; }
.footer-blocks .footer-block:last-child { margin-right: 25%; }

@media (max-width: 1200px) {
  .footer-blocks .footer-block:first-child,
  .footer-blocks .footer-block:last-child {
    margin-left: 0;
    margin-right: 0;
  }
}

@media (max-width: 768px) {
  .footer-blocks {
    flex-direction: column;
    align-items: center;
    gap: 20px;
  }
  .footer-block {
    width: 90%;
    height: auto;
    font-size: 16px;
    padding: 20px;
  }
  .footer-title {
    font-size: 36px;
  }
  .footer-subtitle {
    font-size: 18px;
  }
}
</style>
<!-- Botão fixo do WhatsApp -->
<div class="whatsapp-fixo">
  <a href="https://wa.me/5511998153681" target="_blank">
    <img src="https://imagepng.org/wp-content/uploads/2017/08/whatsapp-icone-1.png" alt="WhatsApp">
  </a>
</div>

<style>
.whatsapp-fixo {
  position: fixed;
  right: 20px;
  bottom: 20px;
  z-index: 999;
}

.whatsapp-fixo img {
  width: 60px;
  height: 60px;
  cursor: pointer;
}
</style>

