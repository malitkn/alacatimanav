<div wire:poll.15s="check">
	
</div>
@script
<script>
   $wire.on('hasNewOrder', () => {
        audio.play().catch(err => console.error('Ses çalma hatası:', err));

        // 25.5 saniye sonra tekrar çal
        setTimeout(() => {
            audio.play().catch(err => console.error('2. ses çalma hatası:', err));
        }, 25500);
    });
	
</script>
@endscript