
      <footer class="full-width">
        <?php wp_footer(); ?>
        <div class="email">

          <p class="label">Work Enquires</p>
          <a href="mailto:hello@brunofelicio.com">hello@brunofelicio.com</a>

        </div>
        <div class="social">
          <p class="label">Follow Me</p>
          <ul>
            <li><a class="twitter" href="https://twitter.com/brunofelici">Twitter</a></li>
            <li><a class="dribbble" href="https://dribbble.com/brunofelicio">Dribbble</a></li>
            <li><a class="instagram" href="https://www.instagram.com/brunofelici/">Instagram</a></li>
            <li><a class="linkedin" href="https://www.linkedin.com/in/brunofelicio/">LinkedIn</a></li>
          </ul>

        </div>
      </footer>
      <!-- Include Google Analytics -->
      <?php include_once("analyticstracking.php") ?>
      <script>
        document.addEventListener("DOMContentLoaded", function() {
    // Check if the body has the 'home' class to apply typewriter animation only on the homepage
    if (document.body.classList.contains('home')) {
        const titles = [
            "Designing Digital Experiences That Matter.",
            "Shaping Products with Purpose and Innovation.",
            "Transforming Ideas into User-Centered Solutions.",
            "Empowering Brands Through Thoughtful Design.",
            "Creating Seamless Journeys for the Modern User."
        ];

        let currentTitleIndex = 0;
        const heroTitle = document.querySelector('.hero h2');
        let typingSpeed = 100;   // Speed of typing
        let deletingSpeed = 50;  // Speed of deleting
        let pauseBeforeDelete = 5000;

        // Function to type the text with fade-in effect
        function typeWriter(text, i, fnCallback) {
            if (i < text.length) {
                // Create a new span for each letter and append it
                const letterSpan = document.createElement('span');
                letterSpan.classList.add('fade-letter');  // Apply fade effect through class
                letterSpan.textContent = text[i];
                heroTitle.appendChild(letterSpan);

                // Trigger the fade-in by adding the active class after a short delay
                setTimeout(() => {
                    letterSpan.classList.add('fade-in');
                }, 10);

                // Move the cursor to the end of the text
                const cursorSpan = document.querySelector('.cursor');
                heroTitle.appendChild(cursorSpan);

                // Continue typing the next letter
                setTimeout(() => typeWriter(text, i + 1, fnCallback), typingSpeed);
            } else if (typeof fnCallback === 'function') {
                setTimeout(fnCallback, 1500);  // Pause after finishing typing
            }
        }

        // Function to delete the text
        function deleteText(text, i, fnCallback) {
            if (i >= 0) {
                const newText = text.substring(0, i);
                heroTitle.innerHTML = '';  // Clear the heroTitle
                newText.split('').forEach(letter => {
                    const letterSpan = document.createElement('span');
                    letterSpan.classList.add('fade-letter');
                    letterSpan.textContent = letter;
                    heroTitle.appendChild(letterSpan);
                });
                // Reappend the cursor to the end
                const cursorSpan = document.createElement('span');
                cursorSpan.classList.add('cursor');
                heroTitle.appendChild(cursorSpan);

                setTimeout(() => deleteText(text, i - 1, fnCallback), deletingSpeed);
            } else if (typeof fnCallback === 'function') {
                fnCallback(); // Once the text is deleted, call the callback
            }
        }

        // Main function to manage typing and deleting
        function startTextAnimation() {
            // Clear the content of the heroTitle before starting new text
            heroTitle.innerHTML = '<span class="cursor" aria-hidden="true"></span>';
            
            typeWriter(titles[currentTitleIndex], 0, function() {
                setTimeout(() => {
                    deleteText(titles[currentTitleIndex], titles[currentTitleIndex].length - 1, function() {
                        currentTitleIndex = (currentTitleIndex + 1) % titles.length;  // Move to the next phrase
                        startTextAnimation();  // Start the next typing cycle
                    });
                }, pauseBeforeDelete); // Pause before starting to delete
            });
        }

        startTextAnimation();
    }
});
      </script>
  </body>
</html>
