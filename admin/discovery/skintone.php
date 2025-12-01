<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekomendasi Warna Kulit - Beauty Tone Advisor</title>
    <style>
        /* CSS Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #d63384;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background-color: #d63384;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        button:hover {
            background-color: #c5307a;
        }
        #result {
            margin-top: 30px;
            padding: 20px;
            background-color: #f0f8ff;
            border-radius: 5px;
            display: none;
        }
        .recommendation {
            margin-bottom: 15px;
        }
        .shade {
            background-color: #fff;
            padding: 10px;
            border-left: 4px solid #d63384;
            margin: 10px 0;
        }
        .formula {
            font-style: italic;
            color: #666;
            font-size: 14px;
            margin-top: 5px;
            padding: 5px;
            background-color: #f9f9f9;
            border-radius: 3px;
        }
        /* Responsif untuk mobile */
        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Beauty Tone Advisor</h1>
        <p style="text-align: center;">Temukan shade dan formula produk kecantikan yang cocok dengan warna dan jenis kulitmu!</p>
        
        <form id="skinToneForm">
            <div class="form-group">
                <label for="undertone">Pilih Undertone Kulitmu:</label>
                <select id="undertone" required>
                    <option value="">-- Pilih Undertone --</option>
                    <option value="warm">Warm (Kuning/Emas)</option>
                    <option value="cool">Cool (Merah/Biru)</option>
                    <option value="neutral">Neutral (Campuran)</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="depth">Pilih Kedalaman Warna Kulit:</label>
                <select id="depth" required>
                    <option value="">-- Pilih Depth --</option>
                    <option value="light">Light (Terang)</option>
                    <option value="medium">Medium (Sedang)</option>
                    <option value="deep">Deep (Gelap)</option>
                </select>
            </div>

            <div class="form-group">
                <label for="skinType">Pilih Jenis Kulitmu:</label>
                <select id="skinType" required>
                    <option value="">-- Pilih Jenis Kulit --</option>
                    <option value="normal">Normal</option>
                    <option value="dry">Kering (Dry)</option>
                    <option value="oily">Berminyak (Oily)</option>
                    <option value="combination">Kombinasi (Combination)</option>
                    <option value="sensitive">Sensibel (Sensitive)</option>
                </select>
            </div>
            
            <button type="submit">Dapatkan Rekomendasi</button>
        </form>
        
        <div id="result">
            <h2>Rekomendasi Lengkap Shade dan Formula untukmu:</h2>
            <div id="foundationRec"></div>
            <div id="lipstickRec"></div>
            <div id="eyeshadowRec"></div>
            <div id="blushRec"></div>
            <div id="highlighterRec"></div>
            <div id="contouringRec"></div>
        </div>
    </div>

    <script>
        // JavaScript untuk Logika Rekomendasi (Dimodifikasi: Tambah Highlighter dan Contouring)
        const recommendations = {
            // Shade berdasarkan undertone + depth (sebelumnya + baru)
            foundation: {
                'warm-light': ['Warm Ivory', 'Golden Beige'],
                'warm-medium': ['Warm Sand', 'Honey Glow'],
                'warm-deep': ['Warm Cocoa', 'Rich Tan'],
                'cool-light': ['Porcelain', 'Cool Rose'],
                'cool-medium': ['Cool Beige', 'Soft Mauve'],
                'cool-deep': ['Cool Ebony', 'Deep Mauve'],
                'neutral-light': ['Neutral Fair', 'Light Neutral'],
                'neutral-medium': ['Medium Neutral', 'Buff'],
                'neutral-deep': ['Deep Neutral', 'Rich Neutral']
            },
            lipstick: {
                'warm-light': ['Peach Nude', 'Coral Pink'],
                'warm-medium': ['Terracotta', 'Warm Red'],
                'warm-deep': ['Brick Red', 'Golden Brown'],
                'cool-light': ['Berry Pink', 'Cool Mauve'],
                'cool-medium': ['Plum', 'Cool Berry'],
                'cool-deep': ['Deep Purple', 'Cool Burgundy'],
                'neutral-light': ['Soft Pink', 'Nude Beige'],
                'neutral-medium': ['Taupe', 'Rosewood'],
                'neutral-deep': ['Mocha', 'Deep Rose']
            },
            eyeshadow: {
                'warm-light': ['Champagne Shimmer', 'Peach Glow'],
                'warm-medium': ['Bronze Matte', 'Golden Taupe'],
                'warm-deep': ['Copper Smoky', 'Warm Brown'],
                'cool-light': ['Silver Sparkle', 'Cool Lilac'],
                'cool-medium': ['Taupe Neutral', 'Purple Haze'],
                'cool-deep': ['Deep Navy', 'Cool Smoky Gray'],
                'neutral-light': ['Soft Beige', 'Neutral Nude'],
                'neutral-medium': ['Rose Gold', 'Muted Taupe'],
                'neutral-deep': ['Deep Mocha', 'Neutral Smoky']
            },
            blush: {
                'warm-light': ['Peach Flush', 'Coral Whisper'],
                'warm-medium': ['Apricot Glow', 'Warm Terracotta'],
                'warm-deep': ['Sunset Peach', 'Rich Coral'],
                'cool-light': ['Soft Pink', 'Rose Petal'],
                'cool-medium': ['Berry Rose', 'Cool Mauve'],
                'cool-deep': ['Deep Berry', 'Plum Flush'],
                'neutral-light': ['Nude Pink', 'Light Mauve'],
                'neutral-medium': ['Taupe Rose', 'Neutral Peach'],
                'neutral-deep': ['Deep Rose', 'Muted Berry']
            },
            // Baru: Highlighter shades
            highlighter: {
                'warm-light': ['Golden Glow', 'Champagne Shimmer'],
                'warm-medium': ['Bronze Highlight', 'Peach Radiance'],
                'warm-deep': ['Warm Gold', 'Sunlit Bronze'],
                'cool-light': ['Pearl White', 'Icy Silver'],
                'cool-medium': ['Cool Rose Glow', 'Moonlight Pearl'],
                'cool-deep': ['Deep Silver', 'Cool Champagne'],
                'neutral-light': ['Neutral Beige Glow', 'Soft Pearl'],
                'neutral-medium': ['Rose Gold Highlight', 'Neutral Shimmer'],
                'neutral-deep': ['Deep Neutral Glow', 'Taupe Radiance']
            },
            // Baru: Contouring shades (untuk shading/kontur wajah)
            contouring: {
                'warm-light': ['Soft Terracotta', 'Warm Taupe'],
                'warm-medium': ['Golden Brown', 'Warm Sienna'],
                'warm-deep': ['Rich Cocoa Contour', 'Deep Bronze'],
                'cool-light': ['Cool Ash', 'Gray Taupe'],
                'cool-medium': ['Cool Mauve Brown', 'Soft Gray'],
                'cool-deep': ['Deep Cool Ebony', 'Cool Charcoal'],
                'neutral-light': ['Neutral Beige', 'Light Taupe'],
                'neutral-medium': ['Medium Neutral Brown', 'Buff Contour'],
                'neutral-deep': ['Deep Neutral Taupe', 'Rich Neutral']
            },
            // Formula berdasarkan skin type (sebelumnya + baru)
            formulas: {
                foundation: {
                    'normal': 'Liquid atau Powder standar (balanced coverage)',
                    'dry': 'Creamy atau Hydrating (mengandung hyaluronic acid)',
                    'oily': 'Matte atau Oil-free (non-comedogenic)',
                    'combination': 'Hybrid Matte-Hydrating (T-zone control)',
                    'sensitive': 'Mineral atau Fragrance-free (hypoallergenic)'
                },
                lipstick: {
                    'normal': 'Creme atau Satin (comfortable wear)',
                    'dry': 'Moisturizing atau Sheer (dengan shea butter)',
                    'oily': 'Matte Liquid (long-lasting, transfer-proof)',
                    'combination': 'Velvet atau Hybrid (balanced finish)',
                    'sensitive': 'Nude atau Gentle formula (no harsh dyes)'
                },
                eyeshadow: {
                    'normal': 'Powder atau Cream (versatile blend)',
                    'dry': 'Creamy atau Dewy (hydrating pigments)',
                    'oily': 'Matte Powder (oil-resistant primer needed)',
                    'combination': 'Buildable Powder (adjustable intensity)',
                    'sensitive': 'Mineral-based (no talc or irritants)'
                },
                blush: {
                    'normal': 'Powder atau Cream (natural flush)',
                    'dry': 'Liquid atau Cream (dewy glow)',
                    'oily': 'Matte Powder (blotting control)',
                    'combination': 'Multi-finish (adaptable to zones)',
                    'sensitive': 'Tinted atau Gentle (fragrance-free)'
                },
                // Baru: Highlighter formulas
                highlighter: {
                    'normal': 'Powder atau Liquid (subtle glow)',
                    'dry': 'Cream atau Stick (hydrating shimmer)',
                    'oily': 'Matte Powder Highlight (minimal oil)',
                    'combination': 'Buildable Liquid (adjustable sheen)',
                    'sensitive': 'Mineral Glow (no glitter irritants)'
                },
                // Baru: Contouring formulas
                contouring: {
                    'normal': 'Powder atau Cream (sculpting definition)',
                    'dry': 'Cream Contour (blendable, hydrating)',
                    'oily': 'Matte Powder (long-wear, no shine)',
                    'combination': 'Hybrid Stick (versatile application)',
                    'sensitive': 'Taupe-based (gentle pigments)'
                }
            }
        };

        document.getElementById('skinToneForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const undertone = document.getElementById('undertone').value;
            const depth = document.getElementById('depth').value;
            const skinType = document.getElementById('skinType').value;
            
            if (!undertone || !depth || !skinType) {
                alert('Silakan pilih undertone, depth, dan jenis kulitmu!');
                return;
            }
            
            const shadeKey = undertone + '-' + depth;
            
            // Ambil data shade
            const foundationShades = recommendations.foundation[shadeKey] || ['Tidak ditemukan'];
            const lipstickShades = recommendations.lipstick[shadeKey] || ['Tidak ditemukan'];
            const eyeshadowShades = recommendations.eyeshadow[shadeKey] || ['Tidak ditemukan'];
            const blushShades = recommendations.blush[shadeKey] || ['Tidak ditemukan'];
            const highlighterShades = recommendations.highlighter[shadeKey] || ['Tidak ditemukan'];
            const contouringShades = recommendations.contouring[shadeKey] || ['Tidak ditemukan'];
            
            // Ambil data formula berdasarkan skinType
            const foundationFormula = recommendations.formulas.foundation[skinType] || 'Formula standar';
            const lipstickFormula = recommendations.formulas.lipstick[skinType] || 'Formula standar';
            const eyeshadowFormula = recommendations.formulas.eyeshadow[skinType] || 'Formula standar';
            const blushFormula = recommendations.formulas.blush[skinType] || 'Formula standar';
            const highlighterFormula = recommendations.formulas.highlighter[skinType] || 'Formula standar';
            const contouringFormula = recommendations.formulas.contouring[skinType] || 'Formula standar';
            
            // Fungsi helper untuk generate HTML per produk
            function generateProductHTML(shades, formula, productName) {
                return `
                    <div class="recommendation">
                        <h3>${productName}:</h3>
                        ${shades.map(shade => `<div class="shade">${shade}</div>`).join('')}
                        <div class="formula">Rekomendasi Formula untuk Jenis Kulit ${skinType.charAt(0).toUpperCase() + skinType.slice(1)}: ${formula}</div>
                    </div>
                `;
            }
            
            // Tampilkan hasil
            document.getElementById('foundationRec').innerHTML = generateProductHTML(foundationShades, foundationFormula, 'Foundation Shade');
            document.getElementById('lipstickRec').innerHTML = generateProductHTML(lipstickShades, lipstickFormula, 'Lipstik Shade');
            document.getElementById('eyeshadowRec').innerHTML = generateProductHTML(eyeshadowShades, eyeshadowFormula, 'Eyeshadow Shade');
            document.getElementById('blushRec').innerHTML = generateProductHTML(blushShades, blushFormula, 'Blush Shade');
            document.getElementById('highlighterRec').innerHTML = generateProductHTML(highlighterShades, highlighterFormula, 'Highlighter Shade');
            document.getElementById('contouringRec').innerHTML = generateProductHTML(contouringShades, contouringFormula, 'Contouring Shade (Shading)');
            
            // Tampilkan div result dan scroll
            document.getElementById('result').style.display = 'block';
            document.getElementById('result').scrollIntoView({ behavior: 'smooth' });
        });
    </script>
</body>
</html>
