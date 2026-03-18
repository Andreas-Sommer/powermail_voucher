const campaignSelectElement = document.querySelector('#campaign');
const campaignListFormElement = document.querySelector('#campaignList');

campaignSelectElement?.addEventListener('change', () => {
    campaignListFormElement?.submit();
});
