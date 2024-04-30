document.getElementById('enroll-button').addEventListener('click', (event) => {
    // Initialize the DigitalPersona scanner
    const scanner = new DigitalPersona.Scanner();
  
    // Scan the fingerprint
    scanner.scan((fingerprintData) => {
      // Use FingerprintJS to generate a fingerprint template
      const fpTemplate = fp.generate(fingerprintData);
  
      // Send the fingerprint template to the PHP server for enrollment
      fetch('enroll.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({fpTemplate}),
      })
      .then((response) => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then((enrollmentResult) => {
        console.log('Enrollment successful:', enrollmentResult);
      })
      .catch((error) => {
        console.error('Error during enrollment:', error);
      });
  
      // Prevent default navigation behavior
      event.preventDefault();
    });
  });