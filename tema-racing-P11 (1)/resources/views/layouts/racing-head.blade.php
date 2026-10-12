<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800|barlow-condensed:600,700,800&display=swap" rel="stylesheet">
<meta name="theme-color" content="#09090b">
<style>
    :root { color-scheme: dark; --rc-red: #e10600; }
    body {
        background-color: #09090b;
        background-image: repeating-linear-gradient(135deg, rgba(255,255,255,.018) 0 2px, transparent 2px 7px);
    }
    ::selection { background: #e10600; color: #fff; }
    h1, h2, .rc-display {
        font-family: 'Barlow Condensed', 'Figtree', ui-sans-serif, system-ui, sans-serif;
        font-style: italic;
        text-transform: uppercase;
        letter-spacing: .02em;
    }
    .rc-topbar { height: 3px; background: linear-gradient(90deg, #e10600 0 72%, #fff 72% 77%, #e10600 77% 100%); }
    .rc-checker {
        background-color: #fafafa;
        background-image: repeating-conic-gradient(#09090b 0% 25%, #fafafa 0% 50%);
        background-size: 16px 16px;
    }
    .rc-stripes { background-image: repeating-linear-gradient(-55deg, rgba(225,6,0,.9) 0 14px, transparent 14px 34px); }
    .rc-tile { background-image: repeating-linear-gradient(-45deg, rgba(255,255,255,.035) 0 6px, transparent 6px 12px); }
    .rc-cut { clip-path: polygon(0 0, 100% 0, 100% calc(100% - 28px), calc(100% - 56px) 100%, 0 100%); }
    input[type="checkbox"] { accent-color: #e10600; }
    input:-webkit-autofill { -webkit-text-fill-color: #f4f4f5; box-shadow: 0 0 0 1000px #09090b inset; }
</style>
