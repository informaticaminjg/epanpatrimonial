import os
import sys
import json
import re
import requests


# ============================================================
# CONFIGURACIÓN OCR.SPACE
# ============================================================

API_URL = "https://api.ocr.space/parse/image"

# ============================================================
# IMPORTANTE:
# PEGÁ ACÁ TU API KEY DE OCR.SPACE
# ============================================================

API_KEY = "K81890988988957"



# ============================================================
# EXTRAER CÓDIGO PATRIMONIAL
# ============================================================

def extraer_codigo(texto):

    if not texto:
        return None

    print()
    print("TEXTO RECIBIDO DE OCR.SPACE:")
    print("--------------------------------------")
    print(texto)
    print("--------------------------------------")

    # Mayúsculas
    texto = texto.upper()

    # --------------------------------------------------------
    # Intentar formato:
    #
    # 424-191973
    # 424 191973
    # 424/191973
    #
    # --------------------------------------------------------

    patrones = [

        r'\b(\d{2,5})\s*[-./]\s*(\d{4,10})\b',

        r'\b(\d{2,5})\s+(\d{4,10})\b',

    ]

    for patron in patrones:

        encontrado = re.search(
            patron,
            texto
        )

        if encontrado:

            parte1 = encontrado.group(1)
            parte2 = encontrado.group(2)

            codigo = (
                parte1 +
                "-" +
                parte2
            )

            return codigo

    # --------------------------------------------------------
    # Buscar números continuos
    #
    # Ej:
    #
    # 424191973
    #
    # --------------------------------------------------------

    numeros = re.findall(
        r'\b\d{7,15}\b',
        texto
    )

    if numeros:

        numero = max(
            numeros,
            key=len
        )

        # ----------------------------------------------------
        # Probar separaciones posibles
        # ----------------------------------------------------

        candidatos = []

        for posicion in range(
            2,
            6
        ):

            if (
                len(numero) - posicion
                >= 4
            ):

                parte1 = numero[
                    :posicion
                ]

                parte2 = numero[
                    posicion:
                ]

                if (
                    4
                    <= len(parte2)
                    <= 10
                ):

                    candidatos.append(
                        parte1 +
                        "-" +
                        parte2
                    )

        if candidatos:

            # Para nuestro formato habitual
            # preferimos 3 + resto

            for candidato in candidatos:

                if candidato.startswith(
                    numero[:3] + "-"
                ):

                    return candidato

            return candidatos[0]

    return None


# ============================================================
# ENVIAR IMAGEN A OCR.SPACE
# ============================================================

def consultar_ocr(ruta):

    print()
    print("======================================")
    print("OCR.SPACE")
    print("======================================")

    print(
        "Imagen:",
        ruta
    )

    # --------------------------------------------------------
    # Abrir archivo
    # --------------------------------------------------------

    try:

        with open(
            ruta,
            "rb"
        ) as archivo:

            archivos = {

                "file": (
                    os.path.basename(ruta),
                    archivo,
                    "image/jpeg"
                )

            }

            datos = {

                "language": "spa",

                # Engine 2 suele ser mejor
                # para caracteres alfanuméricos
                "OCREngine": "2",

                # Importante para imágenes
                # como la tuya
                "scale": "true",

                # No necesitamos overlay
                "isOverlayRequired": "false",

                # Intentar detectar orientación
                "detectOrientation": "true",

                # Tipo de documento
                "isTable": "false",

                # Esperar a que termine
                "OCREngine": "2"

            }

            headers = {

                "apikey":
                    API_KEY

            }

            print(
                "Analizando código..."
            )

            respuesta = requests.post(
                API_URL,
                headers=headers,
                files=archivos,
                data=datos,
                timeout=60
            )

    except Exception as e:

        raise Exception(
            "Error conectando con OCR.space: "
            + str(e)
        )

    print(
        "HTTP:",
        respuesta.status_code
    )

    # --------------------------------------------------------
    # Verificar HTTP
    # --------------------------------------------------------

    if respuesta.status_code != 200:

        raise Exception(
            "OCR.space respondió HTTP "
            + str(respuesta.status_code)
            + ": "
            + respuesta.text
        )

    # --------------------------------------------------------
    # JSON
    # --------------------------------------------------------

    try:

        resultado = respuesta.json()

    except Exception:

        raise Exception(
            "OCR.space no devolvió JSON válido:\n"
            + respuesta.text
        )

    return resultado


# ============================================================
# PROCESAR RESPUESTA
# ============================================================

def procesar_respuesta(resultado):

    print()
    print("======================================")
    print("RESPUESTA OCR.SPACE")
    print("======================================")

    # --------------------------------------------------------
    # Mostrar error de OCR.space
    # --------------------------------------------------------

    if resultado.get(
        "IsErroredOnProcessing",
        False
    ):

        print(
            "ERROR OCR.SPACE:"
        )

        print(
            resultado.get(
                "ErrorMessage"
            )
        )

        return None

    # --------------------------------------------------------
    # Obtener ParsedResults
    # --------------------------------------------------------

    resultados = resultado.get(
        "ParsedResults",
        []
    )

    if not resultados:

        print(
            "OCR.SPACE no devolvió texto."
        )

        return None

    textos = []

    # --------------------------------------------------------
    # Recorrer resultados
    # --------------------------------------------------------

    for resultado_ocr in resultados:

        texto = resultado_ocr.get(
            "ParsedText",
            ""
        )

        if texto:

            print()
            print(
                "TEXTO DETECTADO:"
            )

            print(
                texto
            )

            textos.append(
                texto
            )

    # --------------------------------------------------------
    # Unir textos
    # --------------------------------------------------------

    texto_completo = " ".join(
        textos
    )

    # --------------------------------------------------------
    # Extraer código
    # --------------------------------------------------------

    codigo = extraer_codigo(
        texto_completo
    )

    return {

        "texto": texto_completo,

        "codigo": codigo

    }


# ============================================================
# MAIN
# ============================================================

def main():

    # --------------------------------------------------------
    # Verificar argumento
    # --------------------------------------------------------

    if len(sys.argv) < 2:

        print(
            "Uso:"
        )

        print(
            "python ocr_patrimonial.py test.jpeg"
        )

        return

    ruta = sys.argv[1]

    # --------------------------------------------------------
    # Verificar imagen
    # --------------------------------------------------------

    if not os.path.exists(ruta):

        print(
            json.dumps(
                {
                    "ok": False,
                    "error":
                        "No existe la imagen: "
                        + ruta
                },
                ensure_ascii=False
            )
        )

        return

    # --------------------------------------------------------
    # Verificar API KEY
    # --------------------------------------------------------

    if (
        not API_KEY
        or
        API_KEY == "PEGAR_AQUI_TU_API_KEY"
    ):

        print()
        print(
            "======================================"
        )

        print(
            "FALTA API KEY"
        )

        print(
            "======================================"
        )

        print(
            "Abrí ocr_patrimonial.py"
        )

        print(
            "y reemplazá:"
        )

        print(
            'API_KEY = "PEGAR_AQUI_TU_API_KEY"'
        )

        print(
            "por tu API Key de OCR.space."
        )

        return

    try:

        # ----------------------------------------------------
        # Consultar OCR
        # ----------------------------------------------------

        respuesta = consultar_ocr(
            ruta
        )

        # ----------------------------------------------------
        # Procesar
        # ----------------------------------------------------

        resultado = procesar_respuesta(
            respuesta
        )

        # ----------------------------------------------------
        # No encontrado
        # ----------------------------------------------------

        if not resultado:

            salida = {

                "ok": False,

                "numero_patrimonial":
                    None,

                "texto": ""

            }

            print()
            print(
                json.dumps(
                    salida,
                    ensure_ascii=False,
                    indent=2
                )
            )

            return

        codigo = resultado[
            "codigo"
        ]

        texto = resultado[
            "texto"
        ]

        # ----------------------------------------------------
        # Resultado
        # ----------------------------------------------------

        print()
        print(
            "======================================"
        )

        print(
            "RESULTADO FINAL"
        )

        print(
            "======================================"
        )

        print(
            "TEXTO:",
            texto
        )

        print(
            "NUMERO:",
            codigo
        )

        print(
            "======================================"
        )

        salida = {

            "ok":
                codigo is not None,

            "numero_patrimonial":
                codigo,

            "numero_sin_formato":
                codigo.replace(
                    "-",
                    ""
                )
                if codigo
                else None,

            "texto":
                texto

        }

        print()

        print(
            json.dumps(
                salida,
                ensure_ascii=False,
                indent=2
            )
        )

    except Exception as e:

        print()

        print(
            json.dumps(
                {
                    "ok": False,
                    "error": str(e)
                },
                ensure_ascii=False,
                indent=2
            )
        )


# ============================================================
# EJECUTAR
# ============================================================

if __name__ == "__main__":

    main()