function generateLink() {
    const baseUrl = document.getElementById('baseUrl').value;
    const utmSource = document.getElementById('utmSource').value;
    const utmMedium = document.getElementById('utmMedium').value;
    const utmCampaign = document.getElementById('utmCampaign').value;
    const utmTerm = document.getElementById('utmTerm').value;
    const utmContent = document.getElementById('utmContent').value;

    let utmLink = baseUrl + (baseUrl.includes('?') ? '&' : '?') +
        'utm_source=' + encodeURIComponent(utmSource) +
        '&utm_medium=' + encodeURIComponent(utmMedium) +
        '&utm_campaign=' + encodeURIComponent(utmCampaign) +
        (utmTerm ? '&utm_term=' + encodeURIComponent(utmTerm) : '') +
        (utmContent ? '&utm_content=' + encodeURIComponent(utmContent) : '');

    document.getElementById('generatedLink').textContent = utmLink;
}