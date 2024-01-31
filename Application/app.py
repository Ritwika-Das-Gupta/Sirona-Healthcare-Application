import pandas as pd
import numpy as np
from flask import Flask, render_template, request

app = Flask(__name__)

symptom=pd.read_csv('Symptom-severity.csv')
disease=pd.read_csv('symptom_Description.csv')
prec=pd.read_csv('symptom_precaution.csv')
med=pd.read_csv('medicine_disease.csv')
df=pd.read_csv('dataset.csv')

disease.head()

symptom.head()

prec.head()

df.head()

med.head()

# Merge 'medicine' and 'disease' data on 'Disease' column
merged_data = pd.merge( med,df, on='Disease',how="left")
merged_data = pd.merge( prec,merged_data, on='Disease',how="left")

# Display the merged data
print(merged_data.head())
df=merged_data

# Replacing underscores with spaces in column names
df.columns = df.columns.str.replace('_', ' ')

# Stripping whitespace from the DataFrame values
df = df.applymap(lambda x: x.strip() if isinstance(x, str) else x)

# No need to flatten and reshape as it might distort the original structure
# The above code assumes that the intention is to strip leading/trailing spaces from string columns.


df.fillna(0,inplace=True)

k= df['Disease'].unique()
k=pd.DataFrame(k)
k.rename(columns={k.columns[0]: 'Disease'})

symptom['Symptom'] = symptom['Symptom'].str.replace('_',' ')
symptom.head()

len(symptom['Symptom'].unique())

symptom.drop_duplicates(inplace=True)
len(symptom['Symptom'].unique())

df.drop_duplicates(subset='Disease', inplace=True)

# Aggregate duplicate entries in df_symptom_weights
df_symptom_weights =symptom.groupby('Symptom', as_index=False)['weight'].mean()
df['Disease'].drop_duplicates(inplace=True)
# Reshape the data for collaborative filtering matrix
coll_matrix = df.melt(id_vars='Disease', value_vars=df.columns[1:],
                                       value_name='Symptom') \
    .merge(df_symptom_weights, on='Symptom') \
    .pivot(index='Disease', columns='Symptom', values='weight')
coll_matrix

coll_matrix.fillna(0,inplace=True)
coll_matrix.head()
t = coll_matrix.transpose()
t.head()

# gives similarty of each book based on and its distances
from sklearn.metrics.pairwise import cosine_similarity
similarity_scores=cosine_similarity(t)

similarity_scores
def recommend(symptoms):
    indices = []
    for symptom in symptoms:
        if symptom in t.index:
            indices.append(np.where(t.index == symptom)[0][0])

    if not indices:
        return ["No matching symptoms found. Please check your input."]

    combined_weights = np.zeros(coll_matrix.shape[0])

    for index in indices:
        combined_weights += coll_matrix.iloc[:, index]

    # Normalize combined weights to have values between 0 and 1
    max_weight = max(combined_weights)
    if max_weight > 0:
        combined_weights /= max_weight

    common_diseases = round((combined_weights * 100), 2)
    common_diseases = common_diseases.sort_values(ascending=False)
    common_diseases = common_diseases[common_diseases >= 15]
    top_diseases = common_diseases.index[0:3]  # Top 3 predicted diseases

    # Retrieve corresponding medicines for top predicted diseases
    corresponding_medicines = []
    for disease in top_diseases:
        # Fetch unique medicines and precautions for each disease
        medicines_for_disease = ", ".join(merged_data.loc[merged_data['Disease'] == disease, 'Medicine'].unique())
        prec1 = merged_data.loc[merged_data['Disease'] == disease, 'Precaution 1'].unique()[0]
        prec2 = merged_data.loc[merged_data['Disease'] == disease, 'Precaution 2'].unique()[0]
        prec3 = merged_data.loc[merged_data['Disease'] == disease, 'Precaution 3'].unique()[0]
        prec4 = merged_data.loc[merged_data['Disease'] == disease, 'Precaution 4'].unique()[0]

        # Create a string for each precaution, handling possible NaN values
        prec1 = prec1 if pd.notnull(prec1) else ''
        prec2 = prec2 if pd.notnull(prec2) else ''
        prec3 = prec3 if pd.notnull(prec3) else ''
        prec4 = prec4 if pd.notnull(prec4) else ''

        # Combine medicines and precautions into a single string for each disease
        combined_info = f"{disease}-{medicines_for_disease}*{prec1}, {prec2}, {prec3}, {prec4}"
        # Remove any leading/trailing whitespaces
        combined_info = combined_info.strip(", ")

        # Append formatted strings to corresponding_medicines list
        corresponding_medicines.append(combined_info)

    return corresponding_medicines

@app.route('/', methods=['GET', 'POST'])
def index():
    if request.method == 'GET':
        return render_template('index.html')
    if request.method == 'POST':
        symptoms = request.form['symptoms']
        symptoms_list = symptoms.split(',')
        suggestions = recommend(symptoms_list)

        if suggestions[0] == "No matching symptoms found. Please check your input.":
            return render_template('negative.html', symptoms=symptoms)
        else:
            return render_template('positive.html', suggestions=suggestions, symptoms=symptoms)

if __name__ == '__main__':
    app.run(debug=True)
