 <nav class="nav cn_nav" data-display=""  data-show-single="true" data-active-class="active" data-animate="false" style="margin-bottom: 0">
        <span data-href="<?php echo e(route('chant.index')); ?>"  <?php if(url()->current()==route('chant.index')): ?> class="active" <?php endif; ?> >诵经</span>
        <span data-href="<?php echo e(route('write.index')); ?>"  <?php if(url()->current()==route('write.index')): ?> class="active" <?php endif; ?> >抄经</span>
    </nav>
