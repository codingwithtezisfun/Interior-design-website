$(document).ready(function () {
    const jumbotrons = $('.services-jumbotron-custom');
    const rightContainer = $('.services-right-container');
    const toggleRightPanelBtn = $('#services-toggle-right-panel-btn');
    const showLessBtn = $('<button class="btn btn-primary services-show-less-btn">Show Less</button>');

    jumbotrons.click(function () {
        const selectedJumbotron = $(this);
        const paragraphs = selectedJumbotron.find('.services-paragraph-hidden');

        // Show details for the clicked jumbotron
        paragraphs.removeClass('services-paragraph-hidden').addClass('services-paragraph-visible');

        // Hide all other jumbotrons and show the selected one
        jumbotrons.not(selectedJumbotron).addClass('d-none');
        selectedJumbotron.addClass('expanded');

        // Append show less button below the expanded content
        selectedJumbotron.append(showLessBtn);

        // Show right container and hide toggle button for small screens
        if ($(window).width() < 768) {
            rightContainer.removeClass('d-none');
            toggleRightPanelBtn.addClass('d-none');
        }
    });

    $(document).on('click', '.services-show-less-btn', function () {
        const selectedJumbotron = $(this).closest('.services-jumbotron-custom');

        // Hide the paragraph when show less button is clicked
        selectedJumbotron.find('.services-paragraph-visible').removeClass('services-paragraph-visible').addClass('services-paragraph-hidden');

        // Hide expanded jumbotron and show original container
        jumbotrons.removeClass('d-none');
        selectedJumbotron.removeClass('expanded');
        showLessBtn.remove();
    });

    toggleRightPanelBtn.click(function () {
        rightContainer.css('display', 'flex');
        $(this).css('display', 'none');
    });
});

