    // MPU-6050 Short Example Sketch
    // By Arduino User JohnChi
    // August 17, 2014
    // Public Domain
    #include<Wire.h>
    const int MPU_addr=0x68;  // I2C address of the MPU-6050

    //Variables capteur 
    int AcX = 0;
    int AcY = 0;
    int AcZ = 0;
    int Tmp = 0;
    int GyX = 0;
    int GyY = 0;
    int GyZ = 0;
    
    float Anglex = 0;
    float Angley = 0;
    float Anglez = 0;
    
    void setup()
      {
      Wire.begin();
      Wire.beginTransmission(MPU_addr);
      Wire.write(0x6B);  // PWR_MGMT_1 register
      Wire.write(0);     // set to zero (wakes up the MPU-6050)
      Wire.endTransmission(true);
      Serial.begin(9600);
      }

      int Arrondi(float nombre_float) {
        float nombre;
        nombre = nombre_float - int(nombre_float);
        if (nombre >= 0.5) { nombre = int(nombre_float) + 1; }
        else { nombre = int(nombre_float); }
        return nombre;
      }
      
    void loop()
      {
      Wire.beginTransmission(MPU_addr);
      Wire.write(0x3B);  // starting with register 0x3B (ACCEL_XOUT_H)
      Wire.endTransmission(false);
      Wire.requestFrom(MPU_addr,14,true);  // request a total of 14 registers
      AcX=Wire.read()<<8|Wire.read();  // 0x3B (ACCEL_XOUT_H) & 0x3C (ACCEL_XOUT_L)
      Anglex = 90/1.57 * asin(AcX/16900.000);    
      AcY=Wire.read()<<8|Wire.read();  // 0x3D (ACCEL_YOUT_H) & 0x3E (ACCEL_YOUT_L)
      Angley = 90/1.57 * asin(AcY/16900.000);
      AcZ=Wire.read()<<8|Wire.read();  // 0x3F (ACCEL_ZOUT_H) & 0x40 (ACCEL_ZOUT_L)
      Anglez = 90/1.57 * asin(AcZ/16900.000);
      Tmp=Wire.read()<<8|Wire.read();  // 0x41 (TEMP_OUT_H) & 0x42 (TEMP_OUT_L)
      GyX=Wire.read()<<8|Wire.read();  // 0x43 (GYRO_XOUT_H) & 0x44 (GYRO_XOUT_L)
      GyY=Wire.read()<<8|Wire.read();  // 0x45 (GYRO_YOUT_H) & 0x46 (GYRO_YOUT_L)
      GyZ=Wire.read()<<8|Wire.read();  // 0x47 (GYRO_ZOUT_H) & 0x48 (GYRO_ZOUT_L)

      

      Serial.print("AcX = "); Serial.print(AcX); Serial.print(" \t"); Serial.print("     Angle X = "); Serial.print(Arrondi(Anglex)-80); Serial.println(" degres");
      Serial.print("AcY = "); Serial.print(AcY); Serial.print(" \t"); Serial.print("     Angle Y = "); Serial.print(Arrondi(Angley)); Serial.println(" degres");
      Serial.print("AcZ = "); Serial.print(AcZ); Serial.print(" \t"); Serial.print("     Angle Z = "); Serial.print(Arrondi(Anglez)+5); Serial.println(" degres");
    
     
     
     // Serial.print("Tmp = "); Serial.println(Tmp/340.00+36.53);  //equation for temperature in degrees C from datasheet

      Serial.println(""); Serial.println("-----------------------"); Serial.println("");
        
      delay(3000);
    }

