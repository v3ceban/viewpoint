				<?php

				// Layout Manager - End Layout
				//................................................................
				do_action('output_layout', 'end'); ?>

				</div><!-- .main-content -->
				</div><!-- #Middle -->

				<footer id="Bottom" class="site">
					<?php /* If widgets are being used, display them */ ?>
					<?php if (!dynamic_sidebar('first-footer-area')) : ?>
						<?php /* Footer content if widgets are not being used */ ?>
						<h2>The footer should go here!</h2>
						<p>Yes, right here!</p>
					<?php endif; ?>
					<?php /* If widgets are being used, display them */ ?>
					<?php if (!dynamic_sidebar('second-footer-area')) : ?>
						<?php /* Footer content if widgets are not being used */ ?>
						<h2>The footer should go here!</h2>
						<p>Yes, right here!</p>
					<?php endif; ?>
					<?php /* If widgets are being used, display them */ ?>
					<?php if (!dynamic_sidebar('third-footer-area')) : ?>
						<?php /* Footer content if widgets are not being used */ ?>
						<h2>The footer should go here!</h2>
						<p>Yes, right here!</p>
					<?php endif; ?>
					<?php /* If widgets are being used, display them */ ?>
					<?php if (!dynamic_sidebar('fourth-footer-area')) : ?>
						<?php /* Footer content if widgets are not being used */ ?>
						<h2>The footer should go here!</h2>
						<p>Yes, right here!</p>
					<?php endif; ?>
				</footer><!-- #Bottom -->

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