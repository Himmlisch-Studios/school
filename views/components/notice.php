<?= $this->walk(array_map(
    fn ($v, $i) => [...$v, $i],
    $_SESSION['msg'],
    array_keys(array_values($_SESSION['msg']))
), '<div class="notice %1$s" style="--index: %3$s">%2$s</div>') ?>