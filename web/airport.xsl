<html xsl:version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <body style="font-family:Arial,helvetica,sans-serif;font-size:12pt; background-color:#c0c0c0">
        <xsl:for-each select="airport/flight">
            <div style="background-color:teal;color:white;padding:4px; margin-bottom: 10px">
                <p>
                    Flight:
                    <span style="font-weight:bold;color:white">
                        <xsl:value-of select="number"/></span>
                </p>
                <p>
                    Type aircraft:
                    <span style="font-weight:bold;color:white">
                        <xsl:value-of select="type_aircraft"/></span>
                </p>
                <p>
                    Departure:
                    <span style="font-weight:bold;color:white">
                        <xsl:value-of select="departure/city"/> (<xsl:value-of select="departure/airport_city"/>): <xsl:value-of select="departure/time"/>
                    </span>
                </p>
                <p>
                    Destination:
                    <span style="font-weight:bold;color:white">
                        <xsl:value-of select="destination/city"/> (<xsl:value-of select="destination/airport_city"/>): <xsl:value-of select="destination/time"/>
                    </span>
                </p>
            </div>
        </xsl:for-each>
    </body>
</html>