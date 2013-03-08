alineamiento de secuencias geneticas
========

http://www.programando.org/blog/2013/03/desafio-marzo-slash-abril-adn-forense/

Primer parametros es el archivo de datos, el segundo es debug.

<pre>
?> php secuencias.php datos.txt
El culpable es el sospechoso numero 3 (AGTGATA).
</pre>

<pre>
?> php secuencias.php datos.txt 1
Array
(
    [0] => AGTGATG
    [1] => Array
        (
            [0] => AAATGC
            [1] => AGGAA
            [2] => AGTGATA
            [3] => GATTACA
        )

    [2] => Array
        (
            [A/A] => 5
            [A/C] => -1
            [A/G] => -2
            [A/T] => -1
            [A/] => -3
            [C/A] => -1
            [C/C] => 5
            [C/G] => -3
            [C/T] => -2
            [C/] => -4
            [G/A] => -2
            [G/C] => -3
            [G/G] => 5
            [G/T] => -2
            [G/] => -2
            [T/A] => -1
            [T/C] => -2
            [T/G] => -2
            [T/T] => 5
            [T/] => -1
            [/A] => -3
            [/C] => -4
            [/G] => -2
            [/T] => -1
            [/] => 0
            [AAATGC/AGTGATG] => 11
            [ATGC/GTGATG] => 6
            [GTGATG/TGC] => 4
            [TGATG/TGC] => 6
            [C/TG] => -4
            [/TG] => -3
            [/ATG] => -6
            [GC/GTGATG] => -2
            [/TGATG] => -9
            [C/GATG] => -6
            [/GATG] => -8
            [ATG/C] => -4
            [GC/TGATG] => 0
            [C/TGATG] => -7
            [GATG/GC] => 1
            [ATGC/TGATG] => 8
            [ATGC/GATG] => 9
            [GATG/TGC] => 1
            [ATG/TGC] => 3
            [TG/TGC] => 6
            [ATG/GC] => -3
            [GC/TG] => 0
            [G/GC] => 1
            [ATG/ATGC] => 11
            [AATGC/TGATG] => 8
            [AATGC/GATG] => 9
            [AATGC/ATG] => 8
            [ATGC/G] => -3
            [G/TGC] => 0
            [/TGC] => -7
            [/GC] => -6
            [/ATGC] => -10
            [AGGAA/AGTGATG] => 16
            [AA/TGATG] => -1
            [A/TGATG] => -1
            [A/GATG] => 0
            [A/ATG] => 2
            [AA/GATG] => 0
            [AA/ATG] => 2
            [GAA/GATG] => 7
            [AGTGATA/AGTGATG] => 28
            [AGTGATG/GATTACA] => 5
            [GATTACA/GTGATG] => 6
            [TGATG/TTACA] => 4
            [ATG/TACA] => 0
            [TACA/TG] => -4
            [CA/G] => -6
            [/CA] => -7
            [/ACA] => -10
            [ACA/ATG] => 1
            [A/TG] => -3
            [ACA/TG] => -7
            [CA/TG] => -4
            [ACA/G] => -9
            [ACA/GATG] => -1
            [CA/GATG] => -1
            [ATG/CA] => -2
            [ATTACA/GATG] => -2
            [GATG/TTACA] => -2
            [ATG/TTACA] => -1
            [TG/TTACA] => -5
            [/TACA] => -11
            [GATG/TACA] => -1
            [ATG/ATTACA] => 0
            [AGTGATG/ATTACA] => 7
            [GTGATG/TACA] => 2
            [TACA/TGATG] => 4
            [ACA/GTGATG] => -4
            [CA/GTGATG] => -4
            [A/GTGATG] => -3
            [/GTGATG] => -11
            [CA/TGATG] => -2
            [ACA/TGATG] => -2
            [ATTACA/GTGATG] => 2
            [GTGATG/TTACA] => 2
            [ATTACA/TGATG] => 1
        )

    [3] => 187
    [4] => Array
        (
            [2] => 28
            [1] => 16
            [0] => 11
            [3] => 5
        )

)


El culpable es el sospechoso numero 3 (AGTGATA).
</pre>
