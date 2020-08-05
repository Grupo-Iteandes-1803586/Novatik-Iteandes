$(function() {
    $("input[name='duration']").on('input', function(e) {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });
    $("input[name='minimumSpace']").on('input', function(e) {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });
    $("input[name='orderTrainingCompetition']").on('input', function(e) {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });
    $("input[name='documentPerson']").on('input', function(e) {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });
    $("input[name='phonePerson']").on('input', function(e) {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });
    $("input[name='yearStudyTeacher']").on('input', function(e) {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });
    $("input[name='durationLearningResult']").on('input', function(e) {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });
    $("input[name='minimumSpaceGroup']").on('input', function(e) {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });
    $("input[name='maximumSpaceGroup']").on('input', function(e) {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });
    $("input[name='cantHours']").on('input', function(e) {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });
    $("input[name='gradeYear']").on('input', function(e) {
        $(this).val($(this).val().replace(/[^0-9]/g, ''));
    });
    $("input[name='version']").on('input', function (e) {
        this.value = this.value.replace(/[^0-9,.]/g, '').replace(/,/g, '.');
    });
});