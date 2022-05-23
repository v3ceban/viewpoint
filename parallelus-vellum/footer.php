				<?php

				// Layout Manager - End Layout
				//................................................................
				do_action('output_layout', 'end'); ?>

				</div><!-- .main-content -->
				</div><!-- #Middle -->
				<section id="newsletter-CTA">
					<h2>Be In the Know</h2>
				</section>
				<section id="sponsors">
					<?php if (!dynamic_sidebar('sponsors-widget-area')) : ?>
						<?php /* Footer content if widgets are not being used */ ?>
						<h3>Add an empty widget in this widget area to hide this</h3>
					<?php endif; ?>
				</section>
				<footer id="Bottom" class="site">
					<section class="footer-widget-area">
						<?php if (!dynamic_sidebar('first-footer-area')) : ?>
							<?php /* Footer content if widgets are not being used */ ?>
							<h3>Add an empty widget in this widget area to hide this</h3>
						<?php endif; ?>
					</section>
					<section class="footer-widget-area">
						<?php if (!dynamic_sidebar('second-footer-area')) : ?>
							<?php /* Footer content if widgets are not being used */ ?>
							<h3>Add an empty widget in this widget area to hide this</h3>
						<?php endif; ?>
					</section>
					<section class="footer-widget-area">
						<?php if (!dynamic_sidebar('third-footer-area')) : ?>
							<?php /* Footer content if widgets are not being used */ ?>
							<h3>Add an empty widget in this widget area to hide this</h3>
						<?php endif; ?>
					</section>
					<p id="SMAC">Viewpoint Photographic Art Center is the proud recipient of a SMAC Cultural Arts Award grant</p>
					<section class="footer-widget-area">
						<?php if (!dynamic_sidebar('fourth-footer-area')) : ?>
							<?php /* Footer content if widgets are not being used */ ?>
							<h3>Add an empty widget in this widget area to hide this</h3>
						<?php endif; ?>
					</section>
				</footer><!-- #Bottom -->
				<div id="bottom-line">
					<p>&copy; <?php echo date('Y'); ?> Viewpoint Photographic Art Center, Inc. &#x2022; All rights reserved.</p>
				</div>

				</div> <!-- #ContentWrapper -->
				</div><!-- #page -->

				<?php

				// Login popup window 
				//................................................................
				// - Call with link: <a href="#LoginPopup">Login</a>  
				?>
				<div class="hidden">
					<div id="LoginPopup">
						<form class="loginForm" id="popupLoginForm" method="post" action="<?php echo wp_login_url(); // optional redirect: wp_login_url('/redirect/url/'); 
																							?>">
							<div id="loginBg">
								<div id="loginBgGraphic"></div>
							</div>
							<div class="loginContainer">
								<h3><?php _e('Sign in to your account', 'framework'); ?></h3>
								<fieldset class="formContent">
									<legend><?php _e('Account Login', 'framework'); ?></legend>
									<div class="fieldContainer">
										<label for="ModalUsername"><?php _e('Username', 'framework'); ?></label>
										<input id="ModalUsername" name="log" type="text" class="textInput" />
									</div>
									<div class="fieldContainer">
										<label for="ModalPassword"><?php _e('Password', 'framework'); ?></label>
										<input id="ModalPassword" name="pwd" type="password" class="textInput" />
									</div>
								</fieldset>
							</div>
							<div class="formContent">
								<button type="submit" class="btn signInButton"><span><?php _e('Sign in', 'framework'); ?></span></button>
							</div>
							<div class="hr"></div>
							<div class="formContent">
								<a href="<?php echo site_url() ?>/wp-login.php?action=lostpassword" id="popupLoginForgotPswd"><?php _e('Forgot your password?', 'framework'); ?></a>
							</div>
						</form>
					</div>
				</div>

				<?php

				// Scroll to top button
				//................................................................

				$showBackToTop = (get_options_data('options-page', 'back-to-top', 'false') == 'true') ? true : false;
				if ($showBackToTop) {
				?>
					<div id="BackToTop"><a href="#ScrollTop"><i class="fa fa-chevron-up"></i></a></div>
				<?php
				} ?>

				<?php
				if ($wp_version >= '4.1') {
					if (!is_customize_preview())
						wp_footer();
				} else
					wp_footer();
				?>
				</body>

				</html>