from PIL import Image
import sys

try:
    img_path = r'C:\Users\USER\.gemini\antigravity\brain\c46f7b5b-cd93-4a9e-b140-ac681b45d08a\media__1778480113622.png'
    with Image.open(img_path) as img:
        print(f"Format: {img.format}, Size: {img.size}, Mode: {img.mode}")
        # Resize to 50x50 to find average colors
        small = img.resize((50, 50))
        colors = small.getcolors(2500)
        # Sort by count
        colors.sort(key=lambda x: x[0], reverse=True)
        print("Top 10 dominant colors (Count, RGB):")
        for count, color in colors[:10]:
            print(f"{count}: #{color[0]:02x}{color[1]:02x}{color[2]:02x} (RGB: {color})")
            
        # Let's map pixels to a rough ASCII art to see layout!
        ascii_img = img.resize((40, 80))
        ascii_img = ascii_img.convert("L") # Grayscale
        chars = "@%#*+=-:. "
        print("\nRough Layout ASCII Art:")
        for y in range(ascii_img.height):
            line = ""
            for x in range(ascii_img.width):
                pixel = ascii_img.getpixel((x, y))
                line += chars[pixel * len(chars) // 256]
            print(line)

except Exception as e:
    print(f"Error: {e}")
