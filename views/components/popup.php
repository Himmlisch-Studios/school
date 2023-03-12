<dialog id="himmlisch">
    <?= match (random_int(0, 2)) {
        2 => $this->insert('components/ads/masterpose'),
        1 => $this->insert('components/ads/channel'),
        default => $this->insert('components/ads/web')
    }; ?>
</dialog>