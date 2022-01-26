#!/usr/bin/env python3
# NeoPixel library strandtest example
# Author: Tony DiCola (tony@tonydicola.com)
#
# Direct port of the Arduino NeoPixel library strandtest example.  Showcases
# various animations on a strip of NeoPixels.

import time
from rpi_ws281x import PixelStrip, Color
import argparse
import sys
import parser
from sys import argv

# LED strip configuration:
LED_COUNT = 243   # Number of LED pixels.
LED_PIN = 18          # GPIO pin connected to the pixels (18 uses PWM!).
# LED_PIN = 10        # GPIO pin connected to the pixels (10 uses SPI /dev/spidev0.0).
LED_FREQ_HZ = 800000  # LED signal frequency in hertz (usually 800khz)
LED_DMA = 10          # DMA channel to use for generating signal (try 10)
LED_BRIGHTNESS = 255  # Set to 0 for darkest and 255 for brightest
LED_INVERT = False    # True to invert the signal (when using NPN transistor level shift)
LED_CHANNEL = 0       # set to '1' for GPIOs 13, 19, 41, 45 or 53

zeit = int(argv[1])
duration = zeit * 60 / LED_COUNT
yellow = LED_COUNT * 0.8
red = 218


# Define functions which animate LEDs in various ways.
def green(strip):
    """Wipe color across display a pixel at a time."""
    for i in range(strip.numPixels()):
         if i < yellow:
               strip.setPixelColor(i, Color(0,255,0))
         else:
               if i < red:
                   strip.setPixelColor(i, Color(255,255,0))
               else:
                   strip.setPixelColor(i + 1, Color(255,0,0))
    strip.show()

def timer(strip, wait_ms):
    """Wipe color across display a pixel at a time."""
    strip.show()
    for i in range(strip.numPixels()):
            strip.setPixelColor(i, Color(0,0,0))
            strip.show()
            time.sleep(wait_ms)

def off(strip):
    """Wipe color across display a pixel at a time."""
    for i in range(strip.numPixels()):
        strip.setPixelColor(i, Color(0, 0, 0))
        strip.show()

# Main program logic follows:
if __name__ == '__main__':

    # Create NeoPixel object with appropriate configuration.
    strip = PixelStrip(LED_COUNT, LED_PIN, LED_FREQ_HZ, LED_DMA, LED_INVERT, LED_BRIGHTNESS, LED_CHANNEL)
    # Intialize the library (must be called once before other functions).
    strip.begin()

    try:

            print('Meeting starten')
            green(strip)
            timer(strip, duration)
            off(strip)


    except KeyboardInterrupt:
        if args.clear:
            clear(strip, Color(0, 0, 0))
