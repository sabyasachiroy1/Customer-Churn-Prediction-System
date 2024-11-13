from flask import Flask, render_template, request
import numpy as np
import pandas as pd
import pickle

# Load the pre-trained XGBoost model
model = pickle.load(open('xgboost_model.pkl', 'rb'))

app = Flask(__name__)

@app.route('/')
def home():
    return render_template("index.html")

@app.route('/analysis')
def analysis():
    return render_template("Analysis.html")
@app.route('/about')
def about():
    return render_template("aboutus.html")
@app.route('/featuressection')
def feature():
    return render_template("features.html")






















@app.route('/prediction', methods=['GET', 'POST'])
def prediction():
    if request.method == "POST":
        # Extract form data
        age = int(request.form['age'])
        last_login = int(request.form['last_login'])
        avg_time_spent = float(request.form['avg_time_spent'])
        avg_transaction_value = float(request.form['avg_transaction_value'])
        points_in_wallet = float(request.form['points_in_wallet'])
        date = request.form['date']
        time = request.form['time']
        gender = request.form['gender']
        region_category = request.form['region_category']
        membership_category = request.form['membership_category']
        joined_through_referral = request.form['joined_through_referral']
        preferred_offer_types = request.form['preferred_offer_types']
        medium_of_operation = request.form['medium_of_operation']
        internet_option = request.form['internet_option']
        used_special_discount = request.form['used_special_discount']
        offer_application_preference = request.form['offer_application_preference']
        past_complaint = request.form['past_complaint']
        feedback = request.form['feedback']

        # Initialize feature values
        features = {
            'age': age,
            'days_since_last_login': last_login,
            'avg_time_spent': avg_time_spent,
            'avg_transaction_value': avg_transaction_value,
            'points_in_wallet': points_in_wallet,
            'gender_M': 1 if gender == "M" else 0,
            'gender_Unknown': 1 if gender == "Unknown" else 0,
            'region_category_Town': 1 if region_category == 'Town' else 0,
            'region_category_Village': 1 if region_category == 'Village' else 0,
            'membership_category_Gold Membership': 1 if membership_category == 'Gold Membership' else 0,
            'membership_category_No Membership': 1 if membership_category == 'No Membership' else 0,
            'membership_category_Platinum Membership': 1 if membership_category == 'Platinum Membership' else 0,
            'membership_category_Silver Membership': 1 if membership_category == 'Silver Membership' else 0,
            'membership_category_Premium Membership': 1 if membership_category == 'Premium Membership' else 0,
            'joined_through_referral_No': 1 if joined_through_referral == 'No' else 0,
            'joined_through_referral_Yes': 1 if joined_through_referral == 'Yes' else 0,
            'preferred_offer_types_Gift Vouchers/Coupons': 1 if preferred_offer_types == 'Gift Vouchers/Coupons' else 0,
            'preferred_offer_types_Without Offers': 1 if preferred_offer_types == 'Without Offers' else 0,
            'medium_of_operation_Both': 1 if medium_of_operation == 'Both' else 0,
            'medium_of_operation_Desktop': 1 if medium_of_operation == 'Desktop' else 0,
            'medium_of_operation_Smartphone': 1 if medium_of_operation == 'Smartphone' else 0,
            'internet_option_Mobile_Data': 1 if internet_option == 'Mobile_Data' else 0,
            'internet_option_Wi-Fi': 1 if internet_option == 'Wi-Fi' else 0,
            'used_special_discount_Yes': 1 if used_special_discount == 'Yes' else 0,
            'offer_application_preference_Yes': 1 if offer_application_preference == 'Yes' else 0,
            'past_complaint_Yes': 1 if past_complaint == 'Yes' else 0,
            'feedback_Poor Customer Service': 1 if feedback == 'Poor Customer Service' else 0,
            'feedback_Poor Product Quality': 1 if feedback == 'Poor Product Quality' else 0,
            'feedback_Poor Website': 1 if feedback == 'Poor Website' else 0,
            'feedback_Products always in Stock': 1 if feedback == 'Products always in Stock' else 0,
            'feedback_Quality Customer Care': 1 if feedback == 'Quality Customer Care' else 0,
            'feedback_Reasonable Price': 1 if feedback == 'Reasonable Price' else 0,
            'feedback_Too many ads': 1 if feedback == 'Too many ads' else 0,
            'feedback_User Friendly Website': 1 if feedback == 'User Friendly Website' else 0
        }

        # Convert features to DataFrame
        df = pd.DataFrame([features])

        
        model_feature_names = model.get_booster().feature_names
        df = df.reindex(columns=model_feature_names, fill_value=0)

        # Make prediction
        prediction = model.predict(df)
        p =(prediction * 100)/5
        return render_template("Prediction.html", prediction_text=""" Churn Score is : {} \n out of 5 """.format(prediction[0],p))

    return render_template("Prediction.html")

if __name__ == "__main__":
    app.run(debug=True)
