<section class="flex gap-8 p-8 overflow-y-auto bg-gray-100 min-h-full max-h-full">
    <?php
    $groupId = getPathId();
    if (GroupController::watchGroup($groupId)) {
        SectionController::SectionList($groupId);
    }
    ?>
</section>
<?php include_once __DIR__ . '/../../components/section-form.php'; ?>