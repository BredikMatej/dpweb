function generateLink() {
    // if filled check
    if (!document.getElementById('utmForm').checkValidity()) {
        alert('Please fill all required fields.');
        return;
    }
    //get by id
    const baseUrl = document.getElementById('baseUrl').value;
    let utmSource = document.getElementById('utmSource').value;
    let utmMedium = document.getElementById('utmMedium').value;
    const utmCampaign = document.getElementById('utmCampaign').value;
    const utmTerm = document.getElementById('utmTerm').value;
    const utmContent = document.getElementById('utmContent').value;

    //check if custom element
    if (utmSource === 'custom') {
        utmSource = document.getElementById('customSource').value;  // Use the value from the custom source input
    }

    if (utmMedium === 'custom') {
        utmMedium = document.getElementById('customMedium').value;
    }

    //link creationstr = str.replace(/\s/g, '');
    let utmLink = baseUrl + (baseUrl.includes('?') ? '&' : '?') +
        'utm_source=' + encodeURIComponent(utmSource) +
        '&utm_medium=' + encodeURIComponent(utmMedium) +
        '&utm_campaign=' + encodeURIComponent(utmCampaign.replace(/\s/g, '')) +
        (utmTerm ? '&utm_term=' + encodeURIComponent(utmTerm.replace(/\s/g, '')) : '') +
        (utmContent ? '&utm_content=' + encodeURIComponent(utmContent.replace(/\s/g, '')) : '');

    document.getElementById('generatedLink').textContent = utmLink;
}

document.getElementById('utmMedium').addEventListener('change', function() {
    var customMediumInput = document.getElementById('customMedium');
    if (this.value === 'custom') {
        customMediumInput.style.display = 'block';
        customMediumInput.required = true; // Make custom input required if custom is selected
    } else {
        customMediumInput.style.display = 'none';
        customMediumInput.required = false; // No longer required
        customMediumInput.value = ''; // Clear any input
    }
});

document.getElementById('utmSource').addEventListener('change', function() {
    var customSourceInput = document.getElementById('customSource');
    if (this.value === 'custom') {
        customSourceInput.style.display = 'block';
        customSourceInput.required = true; // Make custom input required if custom is selected
    } else {
        customSourceInput.style.display = 'none';
        customSourceInput.required = false; // No longer required
        customSourceInput.value = ''; // Clear any input
    }
});

let text = document.getElementById('generatedLink').innerHTML;
const copyContent = async () => {
    try {
        const text = document.getElementById('generatedLink').textContent; // Use textContent to get the unencoded text
        await navigator.clipboard.writeText(text);
        console.log('Content copied to clipboard');
    } catch (err) {
        console.error('Failed to copy: ', err);
    }
}